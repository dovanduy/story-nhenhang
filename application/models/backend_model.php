<?php
/**
 * Created by JetBrains PhpStorm.
 * User: tienn2t
 * Date: 4/8/13
 * Time: 5:42 PM
 * To change this template use File | Settings | File Templates.
 */
class Backend_Model extends CI_Model{
    public  function __construct(){
        $this->load->database();
    }

    public function get($collection,$query,$select = ''){
        if(!$collection||!$query){
            return null;
        }
        if($query!=FALSE){
            $this->db->where($query);
        }
        if($select!=''){
            $this->db->select($select);
        }
        $query = $this->db->get($collection);
        return $query->result_array();
    }

    /**
     * @param $collection
     * @param $data
     * @return array(n=>int(0))
     */
    public function insert($collection,$data){
        if(!$collection||!$data){
            return false;
        }
        $result = $this->db->insert($collection,$data);
        if($result['ok']){
            return $this->db->insert_id();
        }
        return false;
    }

    /**
     * @param $collection
     * @param $data
     * @param $query
     * @return bool
     */
    public function update($collection,$data,$query){
        if(!$collection||!$data||!$query){
            return false;
        }
        $this->db->where($query);
        $result = $this->db->update($collection,$data);
        if($result['ok']){
            return true;
        }
        return false;
        //neu la mongo javascript thi update multi document la dung multi, phpmongo la multiple
    }

    function count_documents($collection,$query=FALSE){
        if($query!=FALSE){
            $this->db->where($query);
        }
        $data = $this->db->count_all_results($collection);
        return $data;
    }

    /**
     * @param $action
     * @param $collection
     * @param $query
     * @param bool $limit
     * @param bool $start
     * @param string $select
     * @return mixed
     */
    public function get_pagination($action,$collection,$query,$limit=FALSE,$start=FALSE,$select='',$sort=''){
        if($query!=''){
            $this->db->where($query);
        }
        if($select!=''){
            $this->db->select($select);
        }
        if($action=='total'){
            $campaign = $this->db->count_all_results($collection);
        }else{
            if($sort!=''){
                $this->db->order_by($sort,'DESC');
            }
//            $campaign = $this->get('campaigns',array('advertiser_id'=>new MongoId($advertisers_id)));
            if($limit!=FALSE){
                $campaign = $this->db->get($collection,$limit,$start);
            }else{
                $campaign = $this->db->get($collection);
            }
            return $campaign->result();
        }

        return $campaign;
    }

    /**
     * @param $collection
     * @param bool $query
     * @return bool
     */
    public function delete($collection,$query=FALSE){
        if(!$collection||!$query){
            return false;
        }
        if(!$this->check_null($query)){
            return false;
        }
        $this->db->where($query);
        $result = $this->db->delete($collection);
        if($result['ok']){
            return true;
        }
        return false;
    }
    private function check_null($array)
    {
        foreach ($array as $key => $value) {
            if (is_null($array[$key])) {
                return false;
            }
        }
        return true;
    }



    //count array nested in a document
    public function count_array_nested($action,$query,$limit=FALSE,$start_from = FALSE){
        if($action=='total'){
            if($this->session->userdata('date_search')!=''){
                $op = array(array('$unwind'=>'$funds'),
                    array('$project'=>array('funds'=>1)),$query,array('$group'=>array('_id'=>null,'count'=>array('$sum'=>1))));
                $info = $this->db->aggregate('advertisers',$op);
                if(count($info)>0){
                    return $info[0]['count'];
                }
                return 0;
            }
            $op = array(array('$unwind'=>'$funds'),
                array('$project'=>array('funds'=>1)),$query,array('$group'=>array('_id'=>null,'count'=>array('$sum'=>1))));
            $info = $this->db->aggregate('advertisers',$op);
            if(count($info)>0){
                return $info[0]['count'];
            }
            return 0;
            /*$this->db->select('funds');
            $this->db->where($query);
            $info = $this->db->get('advertisers');
            foreach ($info->result_array() as $rs) {
                return count($rs['funds']);
            }
            return 0;*/
        }else{
            try{
                if($this->session->userdata('date_search')!=''){
                    $op = array(array('$unwind'=>'$funds'),
                        array('$project'=>array('funds'=>1)),$query,array('$skip'=>(int)$start_from),array('$limit'=>(int)$limit)
                    );
                    $info = $this->db->aggregate('advertisers',$op);
                    $result = array();
                    foreach ($info as $rs) {
                        $result[]=$rs['funds'];
                    }
                    return $result;
                }
                //using $slice to get item in array with start and limit
                $this->db->where($query); //echo 'startfrom='.$start_from.'-limit='.$limit;
                $this->db->select(array('amount'=>1,'info.name'=>1,'funds'=>array('$slice'=>array((int)$start_from,(int)$limit))));
                $data = $this->db->get('advertisers');
                $data = $data->result_array();
            }catch (Exception $ex){
                echo $ex->getMessage();
            }
            foreach ($data as $rs) {
                if(count($rs)>0){
                    return $rs['funds'];
                }
            }
            return array();

        }
    }

    public function get_transaction($query='',$limit,$start_from){
        $group = array(
            '_id'=>null,
            'money_bank'=>array(
                '$sum'=>array(
                    '$cond'=>array(array('$eq'=>array('$type','bank')),'$amount',0)
                )
            ),'money_paypal'=>array(
                '$sum'=>array(
                    '$cond'=>array(array('$eq'=>array('$type','paypal')),'$amount',0)
                )
            ),
            'total_card_viettel'=>array(
                '$sum'=>array(
                    '$cond'=>array(array('$and'=>array(array('$eq'=>array('$type','card')),array('$eq'=>array('$input_vendor','viettel')))),'$amount',0)
                )
            ),
            'total_card_vinaphone'=>array(
                '$sum'=>array(
                    '$cond'=>array(array('$and'=>array(array('$eq'=>array('$type','card')),array('$eq'=>array('$input_vendor','vinaphone')))),'$amount',0)
                )
            ),
            'total_card_mobifone'=>array(
                '$sum'=>array(
                    '$cond'=>array(array('$and'=>array(array('$eq'=>array('$type','card')),array('$eq'=>array('$input_vendor','mobifone')))),'$amount',0)
                )
            ),
            'total_card_fpt'=>array(
                '$sum'=>array(
                    '$cond'=>array(array('$and'=>array(array('$eq'=>array('$type','card')),array('$eq'=>array('$input_vendor','fpt')))),'$amount',0)
                )
            ),
            'total_card_mega'=>array(
                '$sum'=>array(
                    '$cond'=>array(array('$and'=>array(array('$eq'=>array('$type','card')),array('$eq'=>array('$input_vendor','mega')))),'$amount',0)
                )
            ),
            'total_card_vtc'=>array(
                '$sum'=>array(
                    '$cond'=>array(array('$and'=>array(array('$eq'=>array('$type','card')),array('$eq'=>array('$input_vendor','vtc')))),'$amount',0)
                )
            ),
            'total_sms_vinaphone'=>array(
                '$sum'=>array(
                    '$cond'=>array(array('$and'=>array(array('$eq'=>array('$type','sms')),array('$eq'=>array('$input_vendor','vinaphone')))),'$amount',0)
                )
            ),
            'total_sms_viettel'=>array(
                '$sum'=>array(
                    '$cond'=>array(array('$and'=>array(array('$eq'=>array('$type','sms')),array('$eq'=>array('$input_vendor','viettel')))),'$amount',0)
                )
            ),
            'total_sms_mobifone'=>array(
                '$sum'=>array(
                    '$cond'=>array(array('$and'=>array(array('$eq'=>array('$type','sms')),array('$eq'=>array('$input_vendor','mobifone')))),'$amount',0)
                )
            )
        );
        if($query!=''){
            $ops = array(
                array('$match'=>$query),
                array('$skip'=>(int)$start_from),
                array('$limit'=>(int)$limit),
                array('$group'=>$group)
            );
        }else{
            $ops = array(
                array('$skip'=>(int)$start_from),
                array('$limit'=>(int)$limit),
                array('$group'=>$group)
            );
        }
        $result = $this->db->aggregate('transactions',$ops);
        if(!$result){
            return array(
                'money_bank'=>0,
                'money_paypal'=>0,
                'total_card_viettel'=>0,
                'total_card_vinaphone'=>0,
                'total_card_mobi'=>0,
                'total_card_fpt'=>0,
                'total_card_vtc'=>0,
                'total_card_mega'=>0,
                'total_sms_viettel'=>0,
                'total_sms_vinaphone'=>0,
                'total_sms_mobi'=>0,
            );
        }
        return $result[0];

    }

    public function get_transaction_dealer($query='',$limit,$start_from){
        $group = array(
            '_id'=>null,
            'sms_card_bank'=>array(
                '$sum'=>array(
                    '$cond'=>array(
                        array(
                            '$or'=>array(
                                array('$eq'=>array('$type','sms')),
                                array('$eq'=>array('$type','card')),
                                array('$eq'=>array('$type','bank'))
                            )),'$amount',0)
                )
            ),'paypal_google_apple'=>array(
                '$sum'=>array(
                    '$cond'=>array(
                        array(
                            '$or'=>array(
                                array('$eq'=>array('$type','paypal')),
                                array('$eq'=>array('$type','google')),
                                array('$eq'=>array('$type','apple'))
                            )),'$amount',0)
                )
            )
        );
        if($query!=''){
            $ops = array(
                array('$match'=>$query),
                array('$skip'=>(int)$start_from),
                array('$limit'=>(int)$limit),
                array('$group'=>$group)
            );
        }else{
            $ops = array(
                array('$skip'=>(int)$start_from),
                array('$limit'=>(int)$limit),
                array('$group'=>$group)
            );
        }
        $result = $this->db->aggregate('transactions',$ops);
        if(!$result){
            return array(
                'sms_card_bank'=>0,
                'paypal_google_apple'=>0
            );
        }
        return $result[0];

    }

    public function get_track_log($query='',$limit='',$start_from=''){
        $group = array(
            '_id'=>'$app_id',
            'total_point'=>array('$sum'=>'$point'),
            'count_install'=>array('$sum'=>1)
        );
        if($query!=''){
            $ops = array(
                array('$match'=>$query)
            );
            if($limit!=''){
                $ops[] = array('$skip'=>(int)$start_from);
                $ops[] = array('$limit'=>(int)$limit);
            }
            $ops[] = array('$group'=>$group);
        }else{
            if($limit!=''){
                $ops = array(
                    array('$skip'=>(int)$start_from),
                    array('$limit'=>(int)$limit)
                );
            }
            $ops[] = array('$group'=>$group);

        }
        $result = $this->db->aggregate('track_log',$ops);

        return $result;

    }
    //lay log cho app chinh
    public function get_install_parent_app($query='',$limit='',$start_from=''){
        $group = array(
            '_id'=>'$store_type',
            'total_revenue'=>array('$sum'=>'$revenue_cpi'),
            'count_install'=>array('$sum'=>1)
        );
        if($query!=''){
            $ops = array(
                array('$match'=>$query)
            );
            if($limit!=''){
                $ops[] = array('$skip'=>(int)$start_from);
                $ops[] = array('$limit'=>(int)$limit);
            }
            $ops[] = array('$group'=>$group);
        }else{
            if($limit!=''){
                $ops = array(
                    array('$skip'=>(int)$start_from),
                    array('$limit'=>(int)$limit)
                );
            }
            $ops[] = array('$group'=>$group);

        }
        $result = $this->db->aggregate('install_app',$ops);

        return $result;

    }
    //lay log cho app chinh
    public function get_track_parent_app($query='',$limit='',$start_from=''){
        $group = array(
            '_id'=>'$store_type',
            'total_point'=>array('$sum'=>'$point'),
            'count_install'=>array('$sum'=>1)
        );
        if($query!=''){
            $ops = array(
                array('$match'=>$query)
            );
            if($limit!=''){
                $ops[] = array('$skip'=>(int)$start_from);
                $ops[] = array('$limit'=>(int)$limit);
            }
            $ops[] = array('$group'=>$group);
        }else{
            if($limit!=''){
                $ops = array(
                    array('$skip'=>(int)$start_from),
                    array('$limit'=>(int)$limit)
                );
            }
            $ops[] = array('$group'=>$group);

        }
        $result = $this->db->aggregate('track_log',$ops);

        return $result;

    }

    public function get_transaction_dealer_by_page($query='',$limit,$start_from){
        $group = array(
            '_id'=>'$application_id',
            'sms_card_bank'=>array(
                '$sum'=>array(
                    '$cond'=>array(
                        array(
                            '$or'=>array(
                                array('$eq'=>array('$type','sms')),
                                array('$eq'=>array('$type','card')),
                                array('$eq'=>array('$type','bank'))
                            )),'$amount',0)
                )
            ),'paypal_google_apple'=>array(
                '$sum'=>array(
                    '$cond'=>array(
                        array(
                            '$or'=>array(
                                array('$eq'=>array('$type','paypal')),
                                array('$eq'=>array('$type','google')),
                                array('$eq'=>array('$type','apple'))
                            )),'$amount',0)
                )
            ),
            'count_transaction'=>array('$sum'=>1)
        );
        if($query!=''){
            $ops = array(
                array('$match'=>$query),
                array('$skip'=>(int)$start_from),
                array('$limit'=>(int)$limit),
                array('$group'=>$group)
            );
        }else{
            $ops = array(
                array('$skip'=>(int)$start_from),
                array('$limit'=>(int)$limit),
                array('$group'=>$group)
            );
        }
        $result = $this->db->aggregate('transactions',$ops);
        return $result;

    }

    public function get_track_log_interval($query='',$limit='',$start_from=''){
        $group = array(
            '_id'=>'$store_type',
            'total_point'=>array('$sum'=>'$point'),
            'count_install'=>array('$sum'=>1)
        );
        if($query!=''){
            $ops = array(
                array('$match'=>$query)
            );
            if($limit!=''){
                $ops[] = array('$skip'=>(int)$start_from);
                $ops[] = array('$limit'=>(int)$limit);
            }
            $ops[] = array('$group'=>$group);
        }else{
            if($limit!=''){
                $ops = array(
                    array('$skip'=>(int)$start_from),
                    array('$limit'=>(int)$limit)
                );
            }
            $ops[] = array('$group'=>$group);

        }
        $result = $this->db->aggregate('track_log',$ops);

        return $result;

    }


    public function get_revenue_interval($query='',$limit='',$start_from=''){
        /*$group = array(
            '_id'=>null,
            'total_vnd'=>array(
                '$sum'=>array(
                    '$cond'=>array(
                        array(
                            '$or'=>array(
                                array('$eq'=>array('$type','sms')),
                                array('$eq'=>array('$type','bank')),
                                array('$eq'=>array('$type','card'))
                            )),'$amount',0)
                )
            ),'total_usd'=>array(
                '$sum'=>array(
                    '$cond'=>array(
                        array(
                            '$or'=>array(
                                array('$eq'=>array('$type','paypal')),
                                array('$eq'=>array('$type','google')),
                                array('$eq'=>array('$type','apple'))
                            )),'$amount',0)
                )
            ),
            'count_transaction'=>array('$sum'=>1)
        );*/
        $group = array(
            '_id'=>'$type',
            'count_transaction'=>array('$sum'=>1),
            'revenue'=>array('$sum'=>'$amount')
        );
        if($query!=''){
            $ops = array(
                array('$match'=>$query)
            );
            if($limit!=''){
                $ops[] = array('$skip'=>(int)$start_from);
                $ops[] = array('$limit'=>(int)$limit);
            }
            $ops[] = array('$group'=>$group);
        }else{
            if($limit!=''){
                $ops = array(
                    array('$skip'=>(int)$start_from),
                    array('$limit'=>(int)$limit)
                );
            }
            $ops[] = array('$group'=>$group);

        }
        $result = $this->db->aggregate('transactions',$ops);

        return $result;

    }
    public function get_export_all_app($query){
        $group = array(
            '_id'=>'$application_id',
            'sms_card_bank'=>array(
                '$sum'=>array(
                    '$cond'=>array(
                        array(
                            '$or'=>array(
                                array('$eq'=>array('$type','sms')),
                                array('$eq'=>array('$type','card')),
                                array('$eq'=>array('$type','bank'))
                            )),'$amount',0)
                )
            ),'paypal_google_apple'=>array(
                '$sum'=>array(
                    '$cond'=>array(
                        array(
                            '$or'=>array(
                                array('$eq'=>array('$type','paypal')),
                                array('$eq'=>array('$type','google')),
                                array('$eq'=>array('$type','apple'))
                            )),'$amount',0)
                )
            ),
            'total_transactions'=>array(
                '$sum'=>1
            )
        );
        $ops = array(
            array('$match'=>$query),
            array('$group'=>$group)
        );
        $result = $this->db->aggregate('transactions',$ops);
        return $result;
    }
    public function getexportdata($query){
        $group = array(
            '_id'=>null,
            'sms_card_bank'=>array(
                '$sum'=>array(
                    '$cond'=>array(
                        array(
                            '$or'=>array(
                                array('$eq'=>array('$type','sms')),
                                array('$eq'=>array('$type','card')),
                                array('$eq'=>array('$type','bank'))
                            )),'$amount',0)
                )
            ),'paypal_google_apple'=>array(
                '$sum'=>array(
                    '$cond'=>array(
                        array(
                            '$or'=>array(
                                array('$eq'=>array('$type','paypal')),
                                array('$eq'=>array('$type','google')),
                                array('$eq'=>array('$type','apple'))
                            )),'$amount',0)
                )
            ),
            'total_transactions'=>array(
                '$sum'=>1
            )
        );
        $ops = array(
            array('$match'=>$query),
            array('$group'=>$group)
        );
        $result = $this->db->aggregate('transactions',$ops);
        if(!$result){
            return array(
                'sms_card_bank'=>0,
                'paypal_google_apple'=>0,
                'total_transactions'=>0
            );
        }
        return $result[0];
    }

    //lay log cho app chinh
    public function get_install_app($query='',$limit='',$start_from=''){
        $group = array(
            '_id'=>'$app_id',
            'count_install'=>array('$sum'=>1)
        );
        if($query!=''){
            $ops = array(
                array('$match'=>$query)
            );
            if($limit!=''){
                $ops[] = array('$skip'=>(int)$start_from);
                $ops[] = array('$limit'=>(int)$limit);
            }
            $ops[] = array('$group'=>$group);
        }else{
            if($limit!=''){
                $ops = array(
                    array('$skip'=>(int)$start_from),
                    array('$limit'=>(int)$limit)
                );
            }
            $ops[] = array('$group'=>$group);

        }
        $result = $this->db->aggregate('install_app',$ops);

        return $result;

    }
    public function insert_batch($collection,$batch_data){
        if(!$collection||!$batch_data){
            return false;
        }
        if($this->db->insert_batch($collection,$batch_data)){
            return true;
        }
        return false;
    }

    public function get_pagination_sort($action,$collection,$query,$limit=FALSE,$start=FALSE,
                                        $select='',$sort='',$sort_type='DESC'){
        if($query!=''){
            $this->db->where($query);
        }
        if($select!=''){
            $this->db->select($select);
        }
        if($action=='total'){
            $campaign = $this->db->count_all_results($collection);
        }else{
            if($sort!=''){
                if($sort_type!=''){
                    $this->db->order_by($sort,$sort_type);
                }else{
                    $this->db->order_by($sort,'DESC');
                }
            }
//            $campaign = $this->get('campaigns',array('advertiser_id'=>new MongoId($advertisers_id)));
            if($limit!=FALSE){
                $campaign = $this->db->get($collection,$limit,$start);
            }else{
                $campaign = $this->db->get($collection);
            }
            return $campaign->result();
        }

        return $campaign;
    }

    public function count_dealer_in_campaign($query){
        $unwind = array('$unwind'=>'$dealer_list');
        $group = array('$group'=>array(
            '_id'=>null,
            'total'=>array('$sum'=>1)
        ));
        $match = array(
            '$match'=>$query
        );
        $ops = array($match,$unwind,$group);
        $result = $this->db->aggregate('campaigns',$ops);
        if(count($result)==0){
            return 0;
        }
        return $result[0]['total'];
    }

    public function get_dealer_by_page($query,$limit,$start){
        if(!$query||!$limit||!is_numeric($limit)||!is_numeric($start)){
            return false;
        }
        $project = array('$project'=>
            array(
                'dealer_list'=>1,
                'campaign_name'=>1,
                'start_time'=>1,
                'end_time'=>1,
                'status'=>1
            ));
        $unwind = array('$unwind'=>'$dealer_list');
        $match = array(
            '$match'=>$query
        );
        $start_ops = array('$skip'=>(int)$start);
        $limit_ops = array('$limit'=>(int)$limit);
        $ops = array($project,$match,$unwind,$start_ops,$limit_ops);
        $result = $this->db->aggregate('campaigns',$ops);

        return $result;
    }

    public function get_map_data(){
        $group = array(
            '_id'=>null,
            'total_dealer'=>array('$sum'=>'$total'),
            'total_verify'=>array('$sum'=>'$total_verify')
        );
        $ops[] = array('$group'=>$group);
        $result = $this->db->aggregate('geo',$ops);
        return $result;
    }

    public function get_search_down_time_on_app($query,$activity_collection){

        $group = array(
            '_id'=>null,
            'total_search'=>array(
                '$sum'=>array(
                    '$cond'=>array(
                        array('$eq'=>array('$activity_type','search')),
                        1,
                        0
                    )
                )
            ),
            'total_download'=>array(
                '$sum'=>array(
                    '$cond'=>array(
                        array('$eq'=>array('$activity_type','download')),
                        1,
                        0
                    )
                )
            ),'total_time_on_app'=>array(
                '$sum'=>array(
                    '$cond'=>array(
                        array('$eq'=>array('$activity_type','time_on_app')),
                        1,
                        0
                    )
                )
            ),
            'total_time_on_app_used'=>array(
                '$sum'=>array(
                    '$cond'=>array(
                        array('$eq'=>array('$activity_type','time_on_app')),
                        '$activity_data',
                        0
                    )
                )
            )
        );
        $ops[] = array('$match'=>$query);
        $ops[] = array('$group'=>$group);
        $result = $this->db->aggregate($activity_collection,$ops);
        return $result;
    }
    public function get_all_collection(){
        return $this->db->get_list_collection();
    }

    public function count_cpi_pending_success($query){
        $group = array(
            '_id'=>null,
            'total_pending'=>array(
                '$sum'=>array(
                    '$cond'=>array(
                        array('$eq'=>array('$status','pending')),
                        1,
                        0
                    )
                )
            ),
            'total_success'=>array(
                '$sum'=>array(
                    '$cond'=>array(
                        array('$eq'=>array('$status','success')),
                        1,
                        0
                    )
                )
            )
        );
        $ops[] = array('$match'=>$query);
        $ops[] = array('$group'=>$group);
        $result = $this->db->aggregate('install_app',$ops);
        return $result;
    }

    public function get_aggregate($query,$group,$collection,$limit='',$start=''){
        if(!is_array($query)){
            return array();
        }
        if(count($query)){
            $ops = array(
                array('$match'=>$query)
            );
        }

        if($limit!=''){
            $ops[] = array('$skip'=>(int)$start);
            $ops[] = array('$limit'=>(int)$limit);
        }
        $ops[] = array('$group'=>$group);
        return $this->db->aggregate($collection,$ops);
    }

    public function get_distinct($collection,$query,$dictinct){
        if(!$collection||($query!=''&&!is_array($query))||!$dictinct){
            return array();
        }
        if($query!=''){
            $this->db->where($query);
        }
        $data = $this->db->distinct($dictinct,$collection);
        return $data;
    }

    /**
     * truncate collection mongo
     * @param $dbname
     * @param $collection
     * @return bool
     */
    public function truncate($dbname,$collection){
        if(!$dbname||!$collection){
            return false;
        }
        $m = new MongoClient();
        $db = $m->$dbname;
        $c = $db->$collection;
        $rs = $c->remove(array());
        if($rs['ok']){
            return true;
        }
        return false;
    }
}
?>