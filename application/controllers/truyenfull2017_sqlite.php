<?php
/**
 * Created by PhpStorm.
 * User: tienn2t
 * Date: 2/26/15
 * Time: 9:55 AM
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/sqlite.php';
class Truyenfull2017_Sqlite extends CI_Controller{
    public function __construct(){
        parent::__construct();
        set_time_limit(0);
        $this->load->model('story_model');
        $this->str = '';
        $this->max = 0;
    }

    public function index(){
        $path = './public/tmp';
		$id = $_GET['id'];
		$chapterTbl = $_GET['tbl'];
		
        if(file_exists($path)){
            unlink($path);
        }
        $db = new Sqlite($path);
        $this->_configTbl($db,1);
        $chapter_table = <<<EOF
            CREATE TABLE IF NOT EXISTS chapter
            (id INTEGER PRIMARY KEY AUTOINCREMENT,
              story_name TEXT,
              chapter_name TEXT,
              content         TEXT,
              read_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		status INTEGER DEFAULT 0);
EOF;
        if(!$db->exec($chapter_table)){
            exit($db->lastErrorMsg());
        }
        $indexes = <<<EOF
	CREATE INDEX status_idx ON chapter(status);
	CREATE INDEX updated_time_idx ON chapter(read_time);
EOF;
        if(!$db->exec($indexes)){
            exit($db->lastErrorMsg());
        }


        $chapters = $this->story_model->get(
            $chapterTbl,
            array(
                'story_id' => $id
            ),
            '',
            'chapter_number',
            'ASC'
        );
        //continue;
        $insert = "INSERT INTO chapter(story_name,chapter_name,content) values(:story_name,:chapter_name,:content)";
        foreach ($chapters as $data) {
			echo $data['chapter_name'].'<br>'.PHP_EOL;
            $smtp = $db->prepare($insert);
            $smtp->bindParam(':story_name', $data['story_name'], SQLITE3_TEXT);
            $smtp->bindParam(':chapter_name', $data['chapter_name'], SQLITE3_TEXT);
            $smtp->bindParam(':content', $data['content'], SQLITE3_TEXT);
            $smtp->execute();
        }
        echo 'done';
        $db->close();
    }

    public function genString($isHeader = true){
        if($isHeader){
            $total = rand(10,20);
            $str = '';
            for($i = 0;$i<$total;$i++){
                while (1){
                    $s = $this->str[rand(0,$this->max)];
                    $s = trim($s);
                    $s = trim($s,'!');
                    $s = trim($s,'.');
                    $s = trim($s,',');
                    if(!empty($s)){
                        break;
                    }
                }
                $str.=' '.ucwords($s);
            }
        }else{
            $total = rand(100,200);
            $str = '';
            for($i = 0;$i<$total;$i++){
                while (1){
                    $s = $this->str[rand(0,$this->max)];
                    $s = trim($s);
                    if(!empty($s)){
                        break;
                    }
                }
                $str.=' '.$s;
            }
        }
        return $str;
    }

    public function virtual($en=true){
        $path = './public/db';
        if(file_exists($path)){
            unlink($path);
        }
        $db = new Sqlite($path);
        $this->_configTbl($db,0);
        $chapter_table = <<<EOF
            CREATE TABLE IF NOT EXISTS chapter
            (id INTEGER PRIMARY KEY AUTOINCREMENT,
              story_name TEXT,
              chapter_name TEXT,
              content         TEXT,
              read_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		status INTEGER DEFAULT 0);
EOF;
        if(!$db->exec($chapter_table)){
            exit($db->lastErrorMsg());
        }
        $indexes = <<<EOF
	CREATE INDEX status_idx ON chapter(status);
	CREATE INDEX updated_time_idx ON chapter(read_time);
EOF;
        if(!$db->exec($indexes)){
            exit($db->lastErrorMsg());
        }
        if($en) {
            $randoms = 'Lorem ipsum dolor sit amet, pro laudem discere ex. Vel virtute dissentiet te, sit nemore placerat expetendis cu. Electram dissentias in sed! Erroribus laboramus instructior an pri.

His eu dico verear ornatus, timeam eleifend inciderint in quo, ei vix amet enim viderer. Eligendi qualisque periculis pro in, id per dolorum iudicabit expetendis. Mazim vituperatoribus ex eam, ea deleniti scripserit pro! Eam eros nullam perpetua eu, ad sonet dictas aliquid usu. Eos option scriptorem ex. Ad qui augue soleat lobortis, debitis deleniti incorrupte eu vis.

Ea pri sint ignota tractatos? Quo cibo bonorum delicatissimi id, tollit recusabo cum ex. Vis ut probatus lobortis facilisis, eos nihil feugait definitiones et. Ea populo prompta comprehensam usu, per ex amet utinam salutatus. Mei autem errem consequat ea. Sea an hinc oportere, cetero nusquam appareat pro no.

Mei no essent laboramus, has etiam iriure detraxit no, id usu feugiat fastidii disputationi. Ei ius tota augue munere, vis dolores tractatos ei. Diam propriae ius id. At mei alii mutat inimicus, sed nemore impetus at! Quo ut atqui aperiam accommodare, etiam eruditi eu duo, est error recteque mediocrem at?

Nec falli lucilius no, mel te dicat admodum comprehensam. Per eu harum euripidis, eum quidam fabulas cotidieque ad? Numquam constituam et nam! Aeque vitae sit ei. Ad vis odio esse viris.

No per repudiare omittantur, nam id expetenda repudiandae. Liber tollit epicuri mea an, ponderum intellegat id mea. Habeo timeam ex sea, usu impedit salutatus prodesset ex! Per solet primis te. Legere facilisi ea vis! Cum in causae complectitur. Viris expetenda iracundia ex cum!

An sea porro harum vituperatoribus? Solum solet ut per, duo iuvaret equidem et. Dicta feugiat suscipit cu ius. Libris epicuri delicata pri ad? Vix ea dico nobis fabellas, usu vero aeterno ut. Mel aeterno ceteros accusata ex. An tantas commune vix, cu nec apeirian democritum.

Tollit dolore apeirian est ne. Usu porro scripta ei, graeco maiestatis mea ut! Ea eos sint labore accusamus. Erat inciderint mea ne, dicit omnes tincidunt per id, his veri complectitur cu.

Vix te dolore commodo habemus, te nostrum erroribus qui. Mea in esse oporteat, et per vero ridens appellantur, qui alterum lucilius sententiae ei? Et falli affert volutpat per, tation argumentum cu pri, vero eripuit his cu. Enim verear aliquam vel ex, ei alia tamquam interpretaris vix? Epicuri blandit per ne, sea diam scripserit ea, ius choro prompta inciderint id. Menandri delicatissimi pri ut. Qui in zril doming labitur, aperiri accusata gloriatur ne est.

Choro accommodare conclusionemque sed ei, porro nonumes usu ex? Accusam senserit forensibus mei an! Sea tale ceteros detraxit ex. Ex mel ipsum constituto constituam, pri te sint recusabo ocurreret! Et has erant voluptua splendide, ius soluta gloriatur persequeris no! Mel id postea doming! Integre aliquid eloquentiam ad vix, ne sea aperiam similique neglegentur.

Mazim corrumpit cu mea! Ius zril postulant percipitur ea. Ne mea labitur consequat scribentur, tacimates disputando cu mel. Ius paulo ridens te, esse minim detraxit his in? Doming consequat repudiandae ex vix, ne dictas aliquando has, sed et essent fabulas. Audire principes eos ad, sit ea nemore tacimates? Sale diceret mandamus duo at, ius id autem diceret probatus.

Ius id volutpat evertitur. Ne qui mutat atqui blandit, congue tantas persecuti id mel! In eos aliquip urbanitas, no fugit consequat cotidieque mei. Etiam partiendo ex has, at latine probatus referrentur eos, et eripuit pertinax assentior pro. His ei putent dolorem deseruisse, vide aliquam necessitatibus ne mea, ut ferri vitae feugiat his. In ius natum omnium timeam, eu oportere posidonium vim. Nibh mnesarchum mei ad.

Ne natum accusam nostrum pri, qui amet nibh illum te! Vel paulo possit et, deserunt dignissim mel eu. Has movet civibus platonem cu, eam et viris assueverit sadipscing. Qui clita option conceptam id? Tota scaevola quaerendum cum no, cum vero prompta ocurreret ea!

Labores splendide in usu, vivendo qualisque molestiae ex eum, et vim modus choro. Vocibus adversarium contentiones ex est, vis ne fugit sensibus, dicant splendide cum ut? Vim id solum causae definitionem, periculis euripidis ut vix. Vis sonet qualisque comprehensam eu, legere impetus contentiones per te? No qui enim ipsum falli, id cum docendi luptatum?

Mea solet homero delenit no, eu sed affert soluta posidonium! Ceteros convenire eum id. Veniam aliquip cu eam. An labores habemus salutandi mel, ridens commodo efficiantur sit et, eros labitur aliquam eam ex? Cu dictas suscipit contentiones has, id sea dicunt delenit adversarium, nec ad feugait vituperatoribus. Te ius summo legendos omittantur, voluptua hendrerit has cu?

Usu movet recteque no, vis an congue voluptatum. Ex mel viderer veritus, assum evertitur liberavisse no eam. Eu solet vitae sed! Vix nobis minimum reprimique in, at cum meis munere placerat, in sit enim vivendum.

Vel vocent tamquam id? Qui ex putent constituto, nihil omnes equidem ex vel. Euismod delicata consectetuer vis ut, altera explicari te his. Vis at amet disputando, an sit esse assueverit! Eam id autem affert adolescens, numquam principes ne nec, eum exerci veritus et? In virtute periculis dissentias cum, no pro summo oratio. Est detracto recteque ad!

Purto minimum at has, dolorem incorrupte eum ad. Nullam sensibus posidonium et cum, eos officiis inimicus ex! In salutandi intellegam usu, vix mollis intellegat ea, ferri mediocrem mea at! Nostro legimus principes no duo, sale nihil adipiscing ei vim?

Eos probo mutat viderer ea, his in saepe mentitum. Accumsan prodesset ut vix, ne intellegam disputationi mei. Per partem tempor concludaturque cu. Mel ut nemore aliquip periculis, eos te nullam labitur, an impedit ceteros postulant mea. Eos ut mutat dictas recusabo? Cum dolore doming in, ne decore integre interpretaris usu?

Audiam blandit appareat has ea, nobis nonumy definiebas ut cum! Ut has ubique commune legendos, conceptam deterruisset eum eu. Ei aliquip fastidii sit, vis admodum singulis necessitatibus id. Qui error copiosae phaedrum ex, id his omnis causae. Brute verear eu sit, nostrum inciderint et qui, mea eius novum ornatus te. Pri an labores repudiandae accommodare, natum primis salutandi in sea.

Ius labores conclusionemque cu, at case omnium mel, errem latine alterum ad duo. An tantas iuvaret concludaturque sea, ut pro mucius utroque. Ei pro dicam sententiae. Ut has dicunt debitis. Ut qui prompta disputationi, his fierent posidonium et. Te invenire senserit mei.

Ei eirmod singulis moderatius quo, usu aperiam officiis ex. Mei ex quod reprimique, erat detraxit no eam! Eu has quando graeco, perpetua conclusionemque eam cu, te virtute salutandi vituperata eum. Essent diceret oportere vis ea. Ei sea nisl ipsum iusto? Id eos partiendo vituperatoribus!

Te lorem voluptatibus pri. Fierent conceptam cu usu, vel an movet audire tritani, et autem iudico mel? Quo fugit qualisque iracundia at, per numquam dolorem recusabo ex. Ut soluta accusam urbanitas has. Viris fastidii ut pri!

Ei quo vero inani erroribus, vix atqui scaevola quaestio no? Mea ex laoreet prodesset. Quas sonet fuisset ex mei, quo sale constituto id! Nostro eligendi copiosae vis no? Inermis vulputate usu et, error oratio voluptatum vel id, eam ut pericula assentior. Adhuc definitionem eu sit, aperiri delicatissimi eam cu, quod cibo ne vis!

Et usu cibo semper aliquando, vel ut tantas aperiam maiorum. Vix ex modus complectitur! Ne usu civibus facilisi principes, quo an saepe ignota volumus. Ei quas altera deserunt mei, usu ea docendi dissentias? Vis cu discere iracundia consetetur, vix cu ornatus conceptam. Ferri meliore mandamus per et, ea diceret corpora vim?

His verear tibique no? Mea at ignota probatus delicatissimi, quem novum sonet in pro. Cu eros velit graece sed? Ea ius decore civibus singulis. Probo corpora quaestio ad cum. Cum eirmod delectus abhorreant id?

Et pro audire fabulas fastidii, facilisis temporibus ne ius? Qui vocent nostrum suscipiantur at. Solum philosophia et pro. Id mea civibus indoctum, per at appetere pericula similique. Cum erat adipisci id, at has mucius fabulas fierent.

Et his clita audire quaerendum, sumo unum expetendis ei usu? Te vel augue virtute accommodare. Te est expetenda efficiendi, qui ei disputando adversarium. Pri accusam invidunt torquatos eu, sit dolorum posidonium ne, mel te homero volumus! Senserit maluisset cu cum! Mel natum reque voluptaria at, eum quem legere te!

Ei euripidis contentiones definitiones vim? Sit dico docendi ad, an tractatos patrioque intellegebat est, per ea harum voluptua. Ei legimus antiopam moderatius eam, aperiam indoctum mel ne, cu vix prima repudiandae. Eam affert minimum theophrastus id, ea nostrum voluptatum est. Per in facete eleifend forensibus! Tale aeque delectus et vix?

Eum ignota fastidii vituperatoribus et! Per ne verear scribentur, pri eruditi instructior et. In tincidunt efficiendi has, deleniti accusamus his ex. Est altera evertitur ex, diam movet dictas per te, et mei delectus lobortis. Sit posse eloquentiam ea, vis iusto lucilius salutandi ei, eu sea magna theophrastus!

No esse aperiri imperdiet cum, mei vulputate consectetuer no. Eros saperet deterruisset et vis? Eu adipisci volutpat sadipscing ius, accusam appareat sadipscing ad his. Posse lobortis comprehensam sit ut, quaeque similique cum ad, nam no dicam urbanitas. Virtute praesent an eam, eu duo aeque tempor aeterno, eum id modo duis consectetuer? Ea eos vidisse indoctum.

At altera officiis nec, malis aliquid percipitur eum an, amet quot legimus at has. In vide putent vim. Cum odio erroribus ad? Cu populo impetus eam?

Ipsum fabellas conclusionemque eu usu, rebum nostro similique est an! Tollit convenire mei in, est oratio tamquam eleifend id, doming everti corrumpit ei eam. Ne mel debitis tibique, has eius tollit dissentiunt cu, illum volutpat id est. Et usu eros apeirian, quod complectitur ea has. Mel case sanctus te.

No sint inermis sed? Eu ius dicta deserunt praesent. Vix omnes aperiri perpetua ne. Sint fierent nec ea. Diam dicta voluptatum ex pri, mea ut albucius definiebas? Pri choro intellegam et, falli doctus rationibus te cum!

Ad mea partiendo intellegat? Ne tractatos accommodare est. Sit ex placerat gloriatur reformidans, nostrud saperet cu eos? Utinam quaeque offendit ea duo, et tamquam tincidunt est! Choro populo mei te. Ei labore urbanitas ius, pro cibo consetetur at!

Suavitate vulputate vim ex, essent timeam consequat his an. Ei quo magna movet argumentum, mei meis fastidii ei, ne ius quidam essent. Cum an natum animal definiebas. Mollis nostrud pertinax et sit, ut quo eripuit mentitum! Oportere principes interesset ex nec, eu vel vero veritus convenire? Ad usu dicta oblique!

Deserunt definiebas ei his, has impetus aperiri indoctum ad? Et eos omnis partem lobortis, brute diceret quaestio usu ei, legere constituto eam ea. Vix no aeque solet mnesarchum, mea cu insolens interpretaris. Id euismod menandri definitionem eos, in cum euismod praesent accusamus. Eu epicurei persequeris qui, in vix noster insolens, commodo imperdiet qui id. Oratio comprehensam et nam. Te pro unum eripuit copiosae, expetenda vituperata vis te?

Cu pri vide vocibus interesset, ea nisl aliquam voluptaria nam! Case iriure splendide vim ei, no qui prima iisque, ocurreret intellegebat est ei. Et cum veniam antiopam interesset, an sea dolore consetetur persequeris. Eum dicunt antiopam appellantur te, eum id ornatus deserunt, pro legere meliore persequeris ne. Sit no nostrum fastidii mediocritatem.

Pri ornatus constituam an, eos ad aliquam patrioque. Et vis legere detraxit instructior. Duo wisi pericula efficiantur ex, dicunt audire et nam! Nemore facete id ius, sonet dissentiet ea vis, tritani facilisi expetenda eu nam? Eam in sale alienum luptatum, cu sit detracto ocurreret.

Cu summo diceret legendos usu. Quando adipisci splendide ne eum? Pri dicam appetere ne, eam eu legendos rationibus? Ut mel antiopam imperdiet definitiones. No vim erant phaedrum qualisque, ne usu ceteros denique mediocritatem.

Ea appetere hendrerit scribentur quo, no noluisse quaerendum cum! Eu qui odio consequat, sea id liber debet errem. Magna latine id eam, sed idque antiopam conclusionemque te. At enim debitis epicuri vix, sonet offendit platonem est ad? Pro no inermis efficiantur, quas percipitur comprehensam an sea, ponderum invidunt laboramus nec ei? Cum an nobis feugait scripserit!

Eum eu scripta assentior adversarium, sea soluta discere ad, te dicant putent moderatius eum. Detracto vulputate sea ea. Te his nostro assentior scribentur, ad suas euismod sed. Sit tota justo in, nec ne appellantur disputationi, vel et veniam incorrupte. Omnis nostrud vituperata at sea, ex torquatos vulputate per.

Aeque partem quaerendum in has, ad omnium aeterno eam? Sea cu sonet albucius torquatos? Sed cu idque latine democritum. Ne suas unum forensibus pri, ferri euripidis interpretaris pro eu! Causae iisque id nam, movet graeci omittantur no mel, ad decore vivendum gloriatur his?

Elit veritus id mea, ut consul utroque constituam eum? Eos eu meis imperdiet rationibus. An wisi prima voluptatibus duo, homero fierent verterem nam et? His an illud intellegat, omnesque postulant signiferumque cu usu. Ad atomorum mandamus mea!

Est cu tempor percipit fabellas, cu vidit expetenda incorrupte duo? Vim id simul laudem. Augue repudiandae ne usu, posse legendos ei has, eum paulo primis qualisque cu! Sea zril placerat ea, ex sit illum probatus conceptam, vim natum facilisi cotidieque cu. Eum choro mollis democritum ei! Posse mnesarchum est ad, vidisse interpretaris no est?

Atqui torquatos sit ne, vidisse urbanitas scribentur eu eum? Nam soluta ocurreret incorrupte et. At his facete neglegentur, vix ea discere euripidis, accusata reprehendunt an sea. Sit porro dicit salutatus no. Minim possim atomorum qui ex, nostrum delectus menandri te ius. Vocibus delectus lobortis ea eos, ne vim tollit viderer suscipiantur.

Ei per docendi tibique atomorum, mel eu ignota timeam. Invidunt mediocrem ullamcorper id usu, semper dolores ocurreret et mei. Timeam appetere sed ut, erat atomorum disputando ea sed. Vel phaedrum efficiantur ei? Postea corrumpit at est, quo velit mundi legere id. Ad decore vivendum sed, mei ei etiam voluptua, iisque periculis instructior no mei.

Ius ut rebum fabulas meliore, agam cetero est te. Cu alia adversarium sea, vocent suscipit voluptatibus eam ad. Verterem laboramus hendrerit eam cu, legere posidonium inciderint usu ne, atomorum maiestatis mei at! Eam te paulo vocibus, primis explicari appellantur ne per? No tota quas utinam mea, liber oblique oporteat te eum.

Ferri dolore impetus ad sea! Nec ex idque sonet labore, est ei wisi choro quando, modo maluisset prodesset an eum. Magna dignissim nec ea, pri at novum soluta noster! Suas debet detraxit ad quo, sea magna falli expetendis ad! Vis viris aliquip cotidieque in, dicat ocurreret vel ea?

Audiam laboramus reprimique eu est, duo an brute atomorum. Elitr facete usu ex. Et nam regione suscipiantur. Ad veri vocent perpetua eos, harum recusabo eos ut?

Eirmod vocibus posidonium ne vim, decore integre utroque per an. Eos putent persecuti mediocritatem at, eu possim similique sit. Ad quo diam deterruisset, mei ipsum malorum interpretaris ne, offendit legendos conceptam ius at. Ex duo stet assum, assum homero theophrastus eum ex. Quas tractatos ius te! Lorem nihil splendide quo an?

Pri esse vide probatus an. Eu per wisi nonumy impetus. An est cetero malorum? Sit eu suscipit hendrerit, cu eam viris democritum. In eum audire meliore detraxit? Pro elitr necessitatibus id. Et aeque facilisi recteque mea, affert fierent delicatissimi an vis?

Simul tritani per id. Cu eum enim blandit. Duo commodo dolorem insolens eu. Cu iriure epicuri splendide eos, percipitur neglegentur no eam! Per te sale constituto, pro inermis vocibus consequat no! Ea duo iriure commodo!

Ut percipit contentiones sea? Id mel affert impedit scripserit. Id eum vidisse discere. Per ut pericula explicari tincidunt, qui ridens detraxit ut. Per dicat zril veritus ut.

Admodum insolens usu ne, ea eum enim dolores, prima meliore democritum ea cum. Verterem erroribus splendide mei ut, eu nostrum phaedrum efficiantur has. Ei percipit ponderum sit, ad ridens invenire eos. Ut sonet argumentum eam, vis quidam euripidis cu?

Id hinc praesent pro! Vis postea habemus intellegat eu, id corpora pertinax mandamus sed. Nihil putent voluptua ei sed! Ut pro scripta denique elaboraret. Ea euismod argumentum scriptorem pri, ad elit scripserit pri, meis magna voluptatum vim ut.

Ne sea hinc vocent vivendum, quo no platonem conceptam, eos ex graeci sapientem efficiendi? Mel alii facilis detracto cu, mea an aliquam interpretaris, doming urbanitas has no. Eirmod virtute qui et! Vidisse deterruisset eam in, no eos tota luptatum expetendis? Eos dicat nulla deserunt ad. Mea augue dicta similique ut, oportere petentium omittantur an sea, duo ex meis accusam suscipit. Vel simul dolorum iracundia at, mea ex ullum repudiandae.

No est reque fabellas vivendum. Nam ex aperiri laboramus concludaturque, nam at elit natum suscipit, ut iudico diceret facilis duo. Wisi novum docendi sea ea? Cum clita eripuit ad!

Ex mei prompta corpora, ut pri dicta persius utroque. Erat liber vel no, error tritani elaboraret ad mei! Nam debet invenire ut, nec eu tollit patrioque, cu utamur epicuri sententiae cum. No brute complectitur pro! Soluta principes est eu, ad vel sint simul tincidunt, ad wisi menandri sea. Libris aperiam rationibus ei eum? Primis interesset ne his, ut persius quaestio inciderint pri.

In animal voluptua duo, no pri agam meliore singulis! Prima minim in sea. Vis id vide vulputate referrentur. Ad putant vocibus percipitur has, ea veri eirmod iudicabit sea! Nam no consequat conceptam moderatius, cum ne tibique fabellas, nostrud insolens reformidans has id. In regione dolores voluptua ius, in vis molestie referrentur, tale mentitum comprehensam ne sit.

Usu te aperiri democritum, eos dico natum ex? Pro ea solet dicant efficiantur. Sed etiam utroque at, noster vivendum in sit, in mel nonumes ceteros. Ei dolor aperiam scripserit quo, adhuc dictas pertinax eu eos, tale prima tritani ex vel. Cu mea eros adhuc, id vel falli persius consequuntur? Ut suas liber blandit has.

Vix te utinam primis mollis, no ius illud audire sanctus, ad sit voluptua detraxit efficiendi. Fabulas atomorum ut mei, et vix delenit legendos conclusionemque? Duo te semper legimus accusata. Eu affert lobortis consequuntur has, mei ex labore volumus torquatos. Tollit accumsan urbanitas ex usu. Perfecto intellegebat pri et, eum ea eirmod volumus deterruisset.

Etiam rationibus sea an, at vel quaestio pericula hendrerit, est no audiam laoreet vituperata? Qui ea autem quidam detracto, et vis admodum vituperata. In adhuc graeco eum. Ceteros invidunt mei te, ne usu graecis scriptorem. Sea laudem fuisset cu, tale everti malorum sed te.

Solum fugit cu quo. Ne omnesque singulis volutpat has, placerat dissentiunt disputationi vim ea. Ad veniam eruditi mel, maiestatis persequeris ex cum, nec prima option nonumes cu! Minimum luptatum ius ut, eu habeo quando saperet duo.

Usu probo exerci id? Has id novum quaeque nominavi, consul reprimique at usu. Mucius essent quaeque ne per! Pri in malorum labitur. Lorem vulputate qui ut, tota fabellas ius ea, duo ad omnes doctus ancillae. Usu salutandi sententiae in.

Facete discere invenire ei vis, vis laoreet inermis inimicus no. Ne mel vituperata elaboraret, eu affert expetenda pri! Ex hinc facer everti sit! Est at simul intellegebat, sit accusam ancillae reformidans ea, sed blandit voluptatum ne.

His et dicta facilisi mediocritatem, affert luptatum ullamcorper ei cum? Pro ne appetere suscipiantur. Adhuc recusabo nam no, dolor adipisci has cu. In sed sanctus tacimates, sit impetus meliore recteque cu, ferri option cu nec.

An has habeo justo, te has assum paulo ullamcorper. At ignota graeco sanctus nam! Noster forensibus ea vim. Modo euismod complectitur cu has, in mazim legere bonorum eum.

Te habeo dolores ancillae duo, ea malis legere eos. Autem ridens euripidis ei pri, his iriure detraxit signiferumque no, pro te modo simul repudiandae? Evertitur abhorreant eu per. Ad dico omnes laoreet ius, pri ponderum mediocrem ea. Aperiam omnesque deserunt nec id, ut pro soleat putant!

Duo no probo definitiones, no duo paulo sonet euripidis. Alia iriure prodesset sea no! Ne vocibus indoctum dignissim nec, modus electram posidonium cum ei, ut sit vidit blandit? Sonet graeco hendrerit has ei! Id eam legere putent ponderum, postea splendide in sea.

Summo appellantur nec no, congue labitur equidem duo ad. Ut nec discere partiendo! Cum quot regione denique ei, nostrud iracundia omittantur ut mel? Et exerci dolorum pertinacia mel, ius ad etiam malorum! Has ea errem viderer scribentur, nec ad stet elit convenire!

No libris aperiam definiebas sed. Ne cum legere praesent, nec ad facer soluta. Ancillae voluptatum eum at, ne graeci nostrum fabellas usu. Id decore suscipiantur qui, usu aperiam deserunt id. Usu maiorum corrumpit ex.

Cu cum oratio aperiri. Liber abhorreant usu te, sea elitr intellegebat an. Habeo volutpat ei per, ut deserunt aliquando est? Has ex impetus definitiones?

Eu nam altera posidonium, modus inimicus ea eum. Mea cu quot vivendo indoctum, usu at cetero concludaturque, in prima tibique mei? Homero oblique eligendi at duo. Sit ad ancillae consulatu philosophia.

Porro noluisse per ea, ea dicam congue facilisi pri. Et mea oratio consectetuer, nam debitis deterruisset comprehensam ea. Nominavi scribentur nam ad, quot gloriatur mea id, has id porro sensibus. Phaedrum deserunt definiebas has ex. Quas eloquentiam consectetuer ne sea, tollit mollis oportere eum ex, diam adversarium in vis.

Graecis intellegam sea id? Graece tamquam prodesset eos at, commodo adipisci dissentias pri an. Pro assum movet ocurreret id, purto inermis oporteat ad sit, nostro debitis eloquentiam nec te? Cibo abhorreant mnesarchum cu eos, eum ad nostrum invenire dissentias. Vim ea eirmod sensibus, deleniti consequuntur per at?

Eum dico atqui graeci in, nisl debet dolore cum at. Rebum facilis intellegebat est in, ei cum vocibus corpora gloriatur. Solet semper debitis et quo, no euismod veritus pri. Ius homero nostrud volumus in, per an oblique equidem nominati. Suas vide cibo vim at, an tempor iisque regione sit!

Eam eu fabellas vivendum legendos, vel cu omnis torquatos, duo viris senserit tractatos at. Ea eam nostro viderer repudiare, pri et illud dictas numquam, cu paulo homero laoreet sit. Ea eos ipsum hendrerit, liber ridens inermis his eu. Erant nihil convenire cu eos, ne nam assum iriure numquam. Cu cibo doctus consetetur vix, ad duo diceret delenit expetendis? Aliquid probatus recusabo qui ex.

Legendos percipitur theophrastus cu mea, vitae virtute fierent ea has, scriptorem deterruisset qui no. Elitr veritus sensibus ei per? Cetero albucius hendrerit cum ex! His oblique delicatissimi in, no vix dolore volumus accusata, nam dolorum lucilius in. Qui dolore placerat id. Verterem phaedrum consectetuer at eum, meis dolorem dignissim sit cu, ea has dolor hendrerit. No alienum facilisis eos, quot tibique ei mel.

Id illum abhorreant has, in vix integre epicuri. At reque bonorum accusata has, iriure sanctus cu quo, cu mei case delenit periculis. Case indoctum ei mei! Eum porro graeci ei, mel prompta intellegat ne.

Pro zril possim insolens an, volumus salutatus sea an, in liber congue delenit nam. Mea ea labore pertinax, ad essent labores pericula vix! Sit quod sint cu, posse animal appareat in pro! Sit prima tollit ei. Nec id eligendi pericula liberavisse, everti iracundia eu vel! Vis cu purto falli, nam ex labores mandamus constituam!

Id legimus mentitum nam. No suscipit insolens postulant mel, ne vero oblique vix, diceret percipit vis at. Eu vero omnes cotidieque ius. Ea ponderum laboramus urbanitas qui? Pro nulla alterum ex.

Virtute deserunt eu has? Ei eum ipsum vocent volutpat. Doming sapientem consectetuer pro ex, ut qui nullam principes corrumpit. Eos mundi tincidunt cu, amet prima vituperatoribus sea te. No munere abhorreant vituperata has? Vix prima consetetur in, oratio feugiat intellegat ut eam!

Sed ei illud iriure, audiam reprehendunt at pri. Pri ad phaedrum dissentias. No sea nonumes lobortis, eum sanctus philosophia an. Et ius odio agam novum, quod purto cum ei? Stet offendit eum te, dicat probatus intellegat nec in. Alterum vocibus eu pri, libris insolens eos id, vel in nobis virtute?

Et vel quidam iisque, qui no melius principes, eu nusquam philosophia instructior vel. Essent legendos adipisci mea ad, probo verear ponderum ut has. Eu duo graeco apeirian suscipiantur. Malis dignissim ex qui. Vel in illud iriure eruditi!

Ad stet facete mei, in qui voluptua consequat! Et enim regione fabulas est. Et intellegam suscipiantur interpretaris mea! Eum debitis eligendi voluptatum eu?

In cum eleifend incorrupte, mei augue tantas mediocritatem ex, eu nam quas prima. Cetero tibique epicurei eu nec! Vix at zril volutpat signiferumque, dolorem platonem perpetua et nec. Tamquam salutandi ei pri, ne mel fabellas laboramus voluptaria!

An illum movet has. Has et erat quaeque? Option bonorum tacimates sed no, ex magna adipisci mandamus vel, eum at laudem vulputate reformidans. Habeo interpretaris ex mel. Eos ea mentitum antiopam, vix nihil sapientem eu. Elitr tractatos ut has, ea has odio alienum?

Cu has errem vocent iracundia, debitis salutandi ex eam! Ei nostrud oportere constituam cum, nam aliquip offendit menandri ei. Id nec timeam fierent assentior! Vis an tantas ancillae iracundia. Delenit prodesset deseruisse usu ne.

Detracto convenire vel ne, nec ea soleat omnium scriptorem? Te ius summo persius tincidunt. Ipsum postea propriae quo an, ut pro suscipit percipitur accommodare, ex his aperiam accommodare. Mei cu persius bonorum partiendo, ne qui utroque habemus detracto. Nominati postulant duo cu? Eum perfecto signiferumque ea, at pro malorum persecuti repudiandae.

Et utroque expetenda gloriatur qui, patrioque posidonium duo id? Pri aperiam consectetuer ut, ad ignota omnium tincidunt mel. Ut vim vide errem vivendum. Odio nobis similique id vim.

Illud ridens possit usu in! Bonorum erroribus ne vis, illum tamquam facilis eu has. Essent verterem ex eam, te atqui labore pro. Et pro iudico ornatus conclusionemque. An choro accumsan posidonium usu, nam enim quaerendum id.

Quis vide homero no has, et eos omnis efficiantur, utinam inermis nec id! Ad cum ludus laudem legendos, mucius diceret ne vix? Eam stet ullum adipisci ut, ei nobis noluisse nam! Ex nam brute posse accommodare, quem iudicabit efficiantur id usu, vel ubique abhorreant eu.

Eu vero petentium qui, ea per natum minim reprehendunt, agam vitae atomorum duo an? Alterum referrentur vim ea! Exerci habemus expetenda sed ne, an pro audiam definitionem! At vel denique appetere tacimates, sit no modo epicurei.

Est cu docendi ancillae salutatus. An liber audiam sed, quem consequat cu eam. At vix vidit ludus delicata, in vix vitae quaestio, pericula consetetur accommodare vel id. Posse prodesset ea ius, in quo hinc paulo deleniti! Id qui vidit labores suavitate, mea modo cetero ullamcorper an, nec electram maiestatis signiferumque in! Minim legimus vim id?

Eirmod interpretaris signiferumque qui in, at aeterno lucilius per! Te accusam tractatos elaboraret eam. Oratio constituto ex cum. Te iuvaret pericula deseruisse usu, aperiam meliore civibus ut ius, cu sea enim harum volumus. Sea noster aperiri sadipscing id, qui ut doming sanctus.

Mei te electram consequuntur? Te falli democritum efficiantur his, vix in viderer sanctus. Vel ea sadipscing disputationi, nec at graeco minimum nostrum, affert putent causae no sea? Harum saperet eos ut, dicat omnium aperiam usu ex. Saepe scaevola menandri eu sea.

Eu gloriatur moderatius cum, civibus qualisque ei vim. An elit oratio voluptatum ius, an eum virtute utroque? An vero persequeris instructior nam, audiam aliquid albucius ne vis. Dicam prompta sed ne, no fugit aliquip eum. Ius dicta malorum ut. Ne usu dicat libris. Elit forensibus pro in.

Oratio dolorum lucilius per te, mea duis corrumpit no. Ea mei doctus graecis complectitur? No vix eirmod nominati, nonumy hendrerit torquatos ex his! Te eam malis ullum choro, sumo dolor abhorreant et pri. Eum populo vocent et. Et cotidieque ullamcorper disputationi eam, te eam aeterno epicurei vulputate.

Usu saepe iudico vivendo eu, his mediocrem omittantur an. Diceret hendrerit sit at, te nec omnis quando primis, homero altera assueverit ut nam! Cotidieque concludaturque ei vim, ea verterem maluisset scriptorem usu, per ea cibo offendit? Adipiscing constituam per in. Liber aliquam periculis ad qui, modo putent scriptorem ut qui, diceret debitis et mei.

Sit stet labore splendide ea, ut est mazim eripuit, ex apeirian pertinax principes ius. Mei magna quodsi tibique at, sit ne cibo quando melius, in nec habeo dolores! Ne aliquid bonorum debitis eam, mea ex atqui petentium.';
        }else{
            $randoms = 'Em năm nay 18 tuổi còn a ấy thì gần 30 rồi ạ . Trước khi yêu em thì a ấy có quen một chị gần 6-7 năm nhưng chị ấy phản bội yêu người khác , trong lúc buồn chán thì gia đình a ấy lại thúc ép cưới một chị khác mà mẹ a ấy đã chon . Chị mới này với a ấy trước kia cũng đã từng quen nhau 2 năm nhưng họ chia tay. Trong lúc gia đình a ấy thúc đẩy việc cưới thì a ấy đã nhận ra có tình cảm với em . Em với a ấy ở chung xóm ra vô gặp mặt nhau nên nảy sinh tình cảm . Lúc đầu e nghĩ mình chỉ xem như anh thôi và ko có tình cảm . Nhưng sau khi nói chuyện và tiếp xúc, anh ấy đưa đón em đi học hằng ngày nên tụi em đã nảy sinh tình cảm lúc nào cũng ko hay. 
  Sau khi đã biết tình cảm cả hai quá nhiều thì anh ấy mới nói với em là a ấy ko yêu chị sắp cưới nhưng vì áp lực gia đính nên a đành làm theo . Nhưng giờ anh ấy sẽ ko như vậy nữa , a ấy quyết định hủy hôn và chọn em . Trong lúc đó thực sự e khó xử và ko biết nên quen ko vì sợ mình là người thứ 3 nhưng vì anh ấy nói a ko có tình cảm với chị đó nên em đã quyết định quen a ấy .
   Chúng em quen nhau , có rất nhiều kỉ niệm đẹp bên nhau và rất nhiều khó khăn , và một ngày khi a ấy nói hủy hôn cho gia đình a ấy và chị đó nghe . Họ đã làm ầm lên và tạo áp lực với a ấy rất nhiều , chị đó đã tới xóm e tìm a ấy . Chính lúc này là tình yêu của tụi em gặp khó khăn nhất . Anh ấy đã quyết định ra Đà Nẵng thứ nhất là mở shop làm ăn thứ 2 là để họ ko tới tìm và chờ qua ngày cưới để mọi chuyện nguôi ngoai . Em cũng chấp nhận để a ấy ra đi . Khi a ấy ra Đà Nẵng thì tụi em vẫn liên lạc bình thường . Cho đến khi em thấy facebook của chị đó đăng lên tấm ảnh 2 người mặc đồ đôi và chụp hình 2 cái chân với nhau . Em mới nhắn hỏi anh ấy thì anh ấy nói tấm hình đó lâu rồi lúc 2 người họ còn quen , Em tìm hiểu thì thấy đúng như anh ấy nói , nên em mới đòi đăng hình tụi em lên facebook thì anh ấy ko cho và nói là đừng đăng vì sợ chị đó sẽ thấy mắc công chị đó buồn và nghĩ quẫn . Lúc đó em cũng hơi khó chịu trong lòng vì anh ấy còn nghĩ cho chị đó nhiều quá nhưng em nghĩ kĩ lại thì thấy anh ấy nói đúng và em ko đăng nữa . Em nhịn một phần là cho tình yêu của tụi em một phần cũng là nghĩ cho chị đó . Nhưng một hôm chị đó nhắn tin với em và hỏi là em và anh ấy còn quen nhau ko , vì a ấy nói em và anh ấy  chia tay rồi . Thực sự lúc đó e rất bất ngờ , em nửa tin nửa ko tin . Nên em đã hỏi a ấy và xác minh sự thật thì đúng là anh ấy có nói , nhưng đó chỉ là trấn an để chị đó ko nghĩ quẩn tự tử cũng như đỡ áp lực với gia đình . Mặc dù trong lòng đau lắm khi nghe những lời đó em đã quát a ấy , rồi cãi nhau nhưng tụi em cũng làm huề lại khi em bay ra Đã Nẵng gặp a ấy .
Tụi em đã đi chơi cùng nhau khi ở Đã Nẵng , rồi về lại Sài Gòn em vẫn nhắn tin nói chuyện với anh ấy hằng ngày . Rồi cứ như vậy đến khi anh ấy nói thật sự a  ấy ko chịu nổi áp lực từ gia đình , và nếu em đi theo anh ấy thì em sẽ khổ . Vì gia đình và công việc anh ấy đang suy sụp và ko tốt như trước . Em đã nói em chấp nhận chịu khổ để bước cùng anh ấy . Nhưng a ấy muốn dừng lại và muốn chúng em đi 2 đường khác nhau . Em thực sự ko giữ dc nữa nên e ko nói gì cả em im lặng từ hôm ấy . Đột nhiên mấy hôm sau em lại nhận được tin nhắn , anh ấy nói anh ấy nhớ em lắm , anh ấy ko kìm dc cảm xúc ko sống dối tình cảm dc . Nhưng vì cuộc sống của anh ấy khác em nhiều quá còn nhiều điều anh ấy ko nói dc từ gia đình đến công việc nên anh ấy chọn cánh dừng lại tình yêu của tui em . Khi nhận được tin nhắn ấy em khóc nhiều lắm , em muốn bước cùng anh ấy nhưng thực sự ko thể vì anh ấy ko muốn . Đến khi em nhắn có người muốn đám hỏi với em , anh ấy nói em đồng ý đi vì cưới người ta rồi em sẽ đi Mỹ tương lai em sẽ tốt hơn khi đi cùng anh ấy . Em đã nói sao anh ko giữ em lại chỉ cần anh nói anh còn thương anh ko muốn em đi thì em sẽ về cạnh anh . Nhưng anh ấy ko giữ em anh ấy chúc em hạnh phúc . Em đau lòng lắm thực sự rất buồn.
  Em không biết đến tháng 9 này anh ấy có đám cưới với chị kia hay ko?? Em sợ điều đó diễn ra lắm .Nhưng anh ấy nói anh ấy có thể sẽ không đám cưới và cùng không bước tiếp cùng em .Mọi người khi biết chuyện ai cũng nói anh ấy không tốt,anh ấy đang giả dối , và không xứng đáng vơi tình cảm của em.Nhưng tận trong lòng em , em tin anh ấy ko phải người như vậy , Nhưng giờ em phải làm sao đây , em thực sự rối lắm .
  Em sợ em đánh mất đi người yêu mình thực sự và họ hi sinh cho em để có cuộc sống tốt hơn.Em cũng sợ anh ấy là người dối trá và không xứng đáng với em như mọi ngưnói.Em rối lắm nên em mong được mọi người giúp em ạ. Em cảm ơn.';
        }
        $this->str = explode(' ',$randoms);
        $this->max = count($this->str)-1;



        //continue;
        $insert = "INSERT INTO chapter(story_name,chapter_name,content) values(:story_name,:chapter_name,:content)";
        for ($i=0;$i<50; $i++) {
            $h = $this->genString(true);
            $content = $this->genString(false);
            echo $h.'<br>';

            $smtp = $db->prepare($insert);
            $smtp->bindParam(':story_name', $h, SQLITE3_TEXT);
            $smtp->bindParam(':chapter_name', $h, SQLITE3_TEXT);
            $smtp->bindParam(':content', $content, SQLITE3_TEXT);
            $smtp->execute();
        }
        echo 'done';
        $db->close();
    }

    public function elle(){
        $path = './public/database';
        if(file_exists($path)){
            unlink($path);
        }
        $db = new Sqlite($path);
        $chapter_table = <<<EOF
            CREATE TABLE IF NOT EXISTS chapter
            (id INTEGER PRIMARY KEY AUTOINCREMENT,
              story_name TEXT,
              chapter_name TEXT,
              content         TEXT,
              read_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		status INTEGER DEFAULT 0);
EOF;
        if(!$db->exec($chapter_table)){
            exit($db->lastErrorMsg());
        }
        $indexes = <<<EOF
	CREATE INDEX status_idx ON chapter(status);
	CREATE INDEX updated_time_idx ON chapter(read_time);
EOF;
        if(!$db->exec($indexes)){
            exit($db->lastErrorMsg());
        }


        $chapters = $this->story_model->get(
            'life_style',
            '',
            '',
            'name',
            'ASC'
        );
        //continue;
        $name = '500 Bí Quyết Sống';
        $insert = "INSERT INTO chapter(story_name,chapter_name,content) values(:story_name,:chapter_name,:content)";
        foreach ($chapters as $data) {
            echo $data['name'].'<br>'.PHP_EOL;
            $smtp = $db->prepare($insert);
            $smtp->bindParam(':story_name', $name, SQLITE3_TEXT);
            $smtp->bindParam(':chapter_name', $data['name'], SQLITE3_TEXT);
            $smtp->bindParam(':content', $data['content'], SQLITE3_TEXT);
            $smtp->execute();
        }
        echo 'done';
        $db->close();
    }
    private function _configTbl($db,$publish = 1){
        $story_table = <<<EOF
            CREATE TABLE IF NOT EXISTS data
            (id INTEGER PRIMARY KEY NOT NULL,
              status  INTEGER DEFAULT 0);
EOF;
        if(!$db->exec($story_table)){
            exit($db->lastErrorMsg());
        }
        $insert = "INSERT INTO data(id,status) values(:id,:status)";
        $smtp = $db->prepare($insert);
        $id = 1;
        $smtp->bindParam(':id', $id, SQLITE3_INTEGER);
        $smtp->bindParam(':status', $publish, SQLITE3_INTEGER);
        $smtp->execute();
    }
    public function story(){
        $path = './public/tmp';
        if(file_exists($path)){
            unlink($path);
        }
        $db = new Sqlite($path);
        $this->_configTbl($db,1);
        //status = 1 la truyen dang doc
        $story_table = <<<EOF
            CREATE TABLE IF NOT EXISTS story
            (id INTEGER PRIMARY KEY NOT NULL,
              category_id INTEGER,
              story_name           TEXT    NOT NULL,
              status  INTEGER DEFAULT 0,
              updated_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
              is_full integer default 0);
EOF;
        if(!$db->exec($story_table)){
            exit($db->lastErrorMsg());
        }
        $chapter_table = <<<EOF
            CREATE TABLE IF NOT EXISTS chapter
            (id INTEGER PRIMARY KEY AUTOINCREMENT,
              story_name TEXT,
              story_id INTEGER,
              chapter_name TEXT,
              chapter_number INTEGER,
              content         TEXT,
              read_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
              save_time TIMESTAMP,
		status INTEGER DEFAULT 0);
EOF;
        if(!$db->exec($chapter_table)){
            exit($db->lastErrorMsg());
        }
        $indexes = <<<EOF
	CREATE INDEX category_idx ON story(category_id);
	CREATE INDEX chapter_number ON chapter(chapter_number);
	CREATE INDEX story_chapter_number ON chapter(story_id,chapter_number);
	CREATE INDEX story_idx ON chapter(story_id);
	CREATE INDEX story_name ON story(story_name);
	CREATE INDEX status_idx ON chapter(status);
	CREATE INDEX updated_time_idx ON chapter(read_time);
EOF;
        if(!$db->exec($indexes)){
            exit($db->lastErrorMsg());
        }
        echo 'done';
        $db->close();
        //$this->import_data(); //dung import theo the loai
        $this->import_story();

    }

    public function import_story(){
        $db = new Sqlite('./public/tmp');
        if(!$db){
            die($db->lastErrorMsg());
        }

        $this->load->model('story_model');
        //doc du lieu tu mysql
        $categories = $this->story_model->get(
            'category',
            '',
            '',
            '',
            '',
            '',
            [29],
            'id'
        );

        $total = 0;
        $order = (!empty($_GET['order']))?$_GET['order']:'ASC';
        foreach($categories as $c){
            /*$insert = "INSERT INTO category(id,category_name) values(:id,:category_name)";
            $smtp = $db->prepare($insert);

            $smtp->bindParam(':id', $c['id'], SQLITE3_INTEGER);
            $smtp->bindParam(':category_name', $c['category_name'], SQLITE3_TEXT);
            $smtp->execute();*/
            $category = $c['id'];
            $lists = $this->story_model->get(
                'story',
                array(
                    'hot'=>55,
                    //'status'=>'Full'
                ),
                '',
                'id',
                $order,
                50
                //array($category),
                //'category_id'
            );
            $storyIds = [];
            foreach($lists as $data) {
                if($data['status'] == 'Full'){
                    $isFull = 3;
                }else{
                    $isFull = 0;
                }
                $insert = "INSERT INTO story(id,story_name,category_id,is_full) values(:id,:story_name,:category_id,:is_full)";
                $smtp = $db->prepare($insert);

                $smtp->bindParam(':id', $data['id'], SQLITE3_INTEGER);
                $smtp->bindParam(':story_name', $data['story_name'], SQLITE3_TEXT);
                $smtp->bindParam(':category_id', $category, SQLITE3_TEXT);
                $smtp->bindParam(':is_full', $isFull, SQLITE3_TEXT);
                $smtp->execute();
                $storyIds[] = $data['id'];

                if($category){
                    $chapter_table = 'chapter_'.substr(trim($data['story_slug']),0,2);
                    if(preg_match('/^[\w\d]-/',substr(trim($data['story_slug']),0,2)) == true){
                        continue;
                    }
                    $chapter_table = strtolower($chapter_table);
                    $limit = 100;
                    $chapters = $this->story_model->get(
                        $chapter_table,
                        array(
                            'story_id' => $data['id']
                        ),
                        '',
                        'chapter_number',
                        'ASC',
                        $limit
                    );
                    echo $data['story_name'].' total = '.count($chapters).'<br>'.PHP_EOL;
                    $total += count($chapters);
                    //continue;
                    $insert = "INSERT INTO chapter(story_name,story_id,chapter_name,
        chapter_number,content) values(:story_name,:story_id,:chapter_name,
        :chapter_number,:content)";
                    foreach ($chapters as $data) {
                        $smtp = $db->prepare($insert);
                        $smtp->bindParam(':story_name', $data['story_name'], SQLITE3_TEXT);
                        $smtp->bindParam(':story_id', $data['story_id'], SQLITE3_INTEGER);
                        $smtp->bindParam(':chapter_name', $data['chapter_name'], SQLITE3_TEXT);
                        $smtp->bindParam(':chapter_number', $data['chapter_number'], SQLITE3_INTEGER);
                        $smtp->bindParam(':content', $data['content'], SQLITE3_TEXT);
                        $smtp->execute();
                    }
                    if($isFull == 3 && count($chapters)<$limit){
                        $update = "UPDATE story SET is_full=1 WHERE id=".$data['id'];
                        $smtp = $db->prepare($update);
                        $smtp->execute();
                    }
                }
            }

        }



        echo 'het nhe total ='.$total;
    }

    public function import_data(){
        $db = new Sqlite('./public/database');
        if(!$db){
            die($db->lastErrorMsg());
        }

        $this->load->model('story_model');
        //doc du lieu tu mysql
        $categories = $this->story_model->get(
            'category',
            '',
            '',
            '',
            '',
            '',
            [4,5],
            'id'
        );

        $total = 0;
        foreach($categories as $c){
            /*$insert = "INSERT INTO category(id,category_name) values(:id,:category_name)";
            $smtp = $db->prepare($insert);

            $smtp->bindParam(':id', $c['id'], SQLITE3_INTEGER);
            $smtp->bindParam(':category_name', $c['category_name'], SQLITE3_TEXT);
            $smtp->execute();*/
            $category = $c['id'];
            $lists = $this->story_model->get(
                'story',
                array(
                    //'hot'=>1,
                    'status'=>'Full'
                ),
                '',
                'id',
                'ASC',
                20,
                array($category),
                'category_id'
            );
            $storyIds = [];
            foreach($lists as $data) {
                if($data['status'] == 'Full'){
                    $isFull = 3;
                }else{
                    $isFull = 0;
                }
                $insert = "INSERT INTO story(id,story_name,category_id,is_full) values(:id,:story_name,:category_id,:is_full)";
                $smtp = $db->prepare($insert);

                $smtp->bindParam(':id', $data['id'], SQLITE3_INTEGER);
                $smtp->bindParam(':story_name', $data['story_name'], SQLITE3_TEXT);
                $smtp->bindParam(':category_id', $category, SQLITE3_TEXT);
                $smtp->bindParam(':is_full', $isFull, SQLITE3_TEXT);
                $smtp->execute();
                $storyIds[] = $data['id'];

                if($category){
                    $chapter_table = 'chapter_'.substr(trim($data['story_slug']),0,2);
                    if(preg_match('/^[\w\d]-/',substr(trim($data['story_slug']),0,2)) == true){
                        continue;
                    }
                    $chapters = $this->story_model->get(
                        $chapter_table,
                        array(
                            'story_id' => $data['id']
                        ),
                        '',
                        'chapter_number',
                        'ASC',
                        70
                    );
                    echo $data['story_name'].' total = '.count($chapters).PHP_EOL;
                    $total += count($chapters);
                    //continue;
                    $insert = "INSERT INTO chapter(story_name,story_id,chapter_name,
        chapter_number,content) values(:story_name,:story_id,:chapter_name,
        :chapter_number,:content)";
                    foreach ($chapters as $data) {
                        $smtp = $db->prepare($insert);
                        $smtp->bindParam(':story_name', $data['story_name'], SQLITE3_TEXT);
                        $smtp->bindParam(':story_id', $data['story_id'], SQLITE3_INTEGER);
                        $smtp->bindParam(':chapter_name', $data['chapter_name'], SQLITE3_TEXT);
                        $smtp->bindParam(':chapter_number', $data['chapter_number'], SQLITE3_INTEGER);
                        $smtp->bindParam(':content', $data['content'], SQLITE3_TEXT);
                        $smtp->execute();
                    }
                    if($isFull == 3 && count($chapters)<30){
                        $update = "UPDATE story SET is_full=1 WHERE id=".$data['id'];
                        $smtp = $db->prepare($update);
                        $smtp->execute();
                    }
                }
            }

        }



        echo 'het nhe total ='.$total;
    }
}
