<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    const DATA = [
        [
            'firstname' => "John",
            'lastname' => "DOE",
            'email' => "john@doe.com",
            'password' => "123456",
            'genre' => "M",
            'roles' => ["ROLE_ADMIN"],
            'birthday' => "1990-12-31"
        ],
        [
            'firstname' => "Jane",
            'lastname' => "DOE",
            'email' => "jane@doe.com",
            'password' => "123456",
            'genre' => "F",
            'roles' => ["ROLE_CONTRIBUTOR"],
            'birthday' => "1990-12-31"
        ],
        [
            'firstname' => "Bob",
            'lastname' => "DOE",
            'email' => "bob@doe.com",
            'password' => "123456",
            'genre' => "N",
            'roles' => [],
            'birthday' => "1990-12-31"
        ],
        // array("firstname"=>"Laith","lastname"=>"Hancock","email"=>"Fusce.dolor@elitdictumeu.org","password"=>"GOD33TBU2KZ","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Aristotle","lastname"=>"Compton","email"=>"vel.est@maurissapiencursus.edu","password"=>"GBK47WDA9SU","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Brent","lastname"=>"Yates","email"=>"in.magna@a.net","password"=>"VSC37AGP9CV","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Baker","lastname"=>"Vincent","email"=>"dui.Cum.sociis@nonsapien.com","password"=>"DTX86MRK6UM","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Beau","lastname"=>"Diaz","email"=>"convallis@acturpisegestas.ca","password"=>"LLY07EPT3DM","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Callum","lastname"=>"Caldwell","email"=>"amet.dapibus.id@adipiscingfringillaporttitor.co.uk","password"=>"UJZ94WVN2JD","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Knox","lastname"=>"Bray","email"=>"ornare.placerat.orci@euismodin.edu","password"=>"ANS73UMU7AC","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Zachary","lastname"=>"Mayer","email"=>"non.magna.Nam@nislelementum.net","password"=>"PTD41AXT6JE","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Samuel","lastname"=>"Evans","email"=>"tristique@adlitora.net","password"=>"YCD85HFD3IS","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Evan","lastname"=>"Brady","email"=>"sem.ut@insodaleselit.com","password"=>"ANH99ZXX1EZ","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Samson","lastname"=>"Mclaughlin","email"=>"montes.nascetur@pedeet.edu","password"=>"WKR35NLC5CQ","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Hoyt","lastname"=>"Harrell","email"=>"congue@eleifendegestasSed.ca","password"=>"TAX31HRJ6BI","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Burke","lastname"=>"Mcmahon","email"=>"metus.sit@velpede.co.uk","password"=>"ALA59GVV9FH","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Hayden","lastname"=>"Mcdonald","email"=>"dictum.eleifend.nunc@elit.org","password"=>"VLH98YLG3FF","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"William","lastname"=>"Christian","email"=>"Aliquam.ultrices.iaculis@Quisquelibero.ca","password"=>"LZY39WIM7TG","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Merritt","lastname"=>"Sears","email"=>"magnis.dis@convallisante.edu","password"=>"DMU55UVB8JS","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Cole","lastname"=>"Bishop","email"=>"Nulla.tempor@estNuncullamcorper.com","password"=>"DKN76RCE4SP","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Dylan","lastname"=>"Cook","email"=>"non.magna@disparturientmontes.co.uk","password"=>"GUN53SLM6AM","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Marshall","lastname"=>"Barr","email"=>"accumsan.laoreet@Craspellentesque.org","password"=>"CAW91PTW8GW","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Kamal","lastname"=>"Best","email"=>"sed@pedeblanditcongue.org","password"=>"XQV87IZI7HG","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Hammett","lastname"=>"Rich","email"=>"semper.Nam.tempor@lorem.org","password"=>"ENV87UFU4RO","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Lane","lastname"=>"Macias","email"=>"elit.Etiam.laoreet@a.org","password"=>"JGQ03XDS3BM","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Emmanuel","lastname"=>"Kirkland","email"=>"egestas.ligula@neque.org","password"=>"HJO93WKW1JT","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Holmes","lastname"=>"Clark","email"=>"at.velit.Cras@dolorsitamet.edu","password"=>"MVI91NPS5RG","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Orlando","lastname"=>"Mendoza","email"=>"mauris.Morbi@congueaaliquet.com","password"=>"EET23DBZ0RM","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Ishmael","lastname"=>"Hanson","email"=>"Sed@lacusEtiam.net","password"=>"TSD24AEV7HZ","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Ethan","lastname"=>"Randolph","email"=>"facilisis@ipsumSuspendisse.edu","password"=>"IBB27WHN4UF","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Brandon","lastname"=>"Miles","email"=>"nibh.enim@lacusEtiam.co.uk","password"=>"BUN99AFF4FT","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Acton","lastname"=>"Maddox","email"=>"tincidunt.pede@enim.co.uk","password"=>"UEG65PWG3YH","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Basil","lastname"=>"Valencia","email"=>"faucibus.orci@enimconsequatpurus.com","password"=>"CUH93BHJ3ND","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Barrett","lastname"=>"Hughes","email"=>"ridiculus.mus@lectusrutrumurna.net","password"=>"KCT44YWD4XV","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Nathaniel","lastname"=>"Ewing","email"=>"ut.aliquam.iaculis@lobortisnisinibh.edu","password"=>"XJG33SZL6YR","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Magee","lastname"=>"Quinn","email"=>"enim.Mauris@atlacusQuisque.ca","password"=>"GDM63XCJ0QM","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Armand","lastname"=>"Conway","email"=>"Cras.convallis.convallis@nonlobortisquis.edu","password"=>"ITZ47DER0EY","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Griffith","lastname"=>"Carver","email"=>"habitant.morbi@Maurisblanditenim.edu","password"=>"BOI68ILP0RL","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Wang","lastname"=>"Peck","email"=>"elementum.lorem.ut@egestasSedpharetra.ca","password"=>"UTK54PTJ7SA","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Wayne","lastname"=>"Richmond","email"=>"eros@Nullamfeugiat.org","password"=>"KCX60WZH3LL","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Francis","lastname"=>"Knox","email"=>"Integer@mollis.net","password"=>"CVG02EMB4HY","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Dane","lastname"=>"Kramer","email"=>"Donec.at.arcu@ac.ca","password"=>"QDG60EWZ4IL","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Ciaran","lastname"=>"Middleton","email"=>"Duis.a@sit.net","password"=>"DDQ73ZMZ7BK","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Lucas","lastname"=>"Gay","email"=>"pellentesque.eget@dictumeuplacerat.co.uk","password"=>"EUU58NCE1FF","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Emery","lastname"=>"Weiss","email"=>"suscipit@atrisusNunc.edu","password"=>"NIB27KWX4PX","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Elvis","lastname"=>"Solis","email"=>"lorem@antedictum.ca","password"=>"FDU52JDP4FQ","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Nigel","lastname"=>"Moore","email"=>"Suspendisse.commodo.tincidunt@estNunclaoreet.co.uk","password"=>"WBC54ODZ2OU","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Marsden","lastname"=>"Odonnell","email"=>"consequat.auctor.nunc@liberoProin.org","password"=>"AWA02DRZ5PC","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Barry","lastname"=>"Gonzalez","email"=>"nisi.sem.semper@turpisAliquam.ca","password"=>"LHY61OFG1HQ","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Tate","lastname"=>"Beach","email"=>"at.pede.Cras@pedeCrasvulputate.com","password"=>"DIC94ETL4JB","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Felix","lastname"=>"Hester","email"=>"volutpat.nunc@enimgravidasit.ca","password"=>"ISQ92OJN9GM","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Michael","lastname"=>"Mcknight","email"=>"tempor.erat@massaQuisque.edu","password"=>"PFX65YKJ5HA","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Kibo","lastname"=>"Bernard","email"=>"luctus@aliquet.net","password"=>"ECG98ZKV1XZ","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Brady","lastname"=>"Bennett","email"=>"pulvinar.arcu.et@tortorNunc.net","password"=>"DGR47ILZ1DE","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Aidan","lastname"=>"Leon","email"=>"sodales.nisi@Morbiaccumsan.com","password"=>"CAM18ONW4UZ","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Zachary","lastname"=>"Miles","email"=>"rutrum@turpisIn.org","password"=>"HDH19AOM7VT","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Levi","lastname"=>"Bridges","email"=>"tristique.pellentesque.tellus@Fuscealiquetmagna.org","password"=>"UJB12CHH1TR","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Ryan","lastname"=>"Morin","email"=>"pharetra.nibh@pellentesqueSed.org","password"=>"EGG88KKK2QE","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Owen","lastname"=>"Thompson","email"=>"Phasellus.vitae@odio.net","password"=>"CME27NNO3BQ","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Amal","lastname"=>"Shaffer","email"=>"amet.consectetuer.adipiscing@idantedictum.com","password"=>"NNZ94CEE9RV","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Chaim","lastname"=>"Shannon","email"=>"ac.ipsum@nonummy.edu","password"=>"WMN45KSR3HK","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Alan","lastname"=>"Harper","email"=>"tempus.lorem.fringilla@interdumCurabitur.com","password"=>"NIB20LXP2CP","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Ashton","lastname"=>"Steele","email"=>"ornare.lectus@nonummyutmolestie.org","password"=>"AFX49WMT9AB","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Cedric","lastname"=>"Melton","email"=>"non.lacinia@nequeNullam.ca","password"=>"VMN20UXL0HN","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Ulysses","lastname"=>"Stanley","email"=>"nec@nibh.com","password"=>"BQU24NMB2FK","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Amir","lastname"=>"Rich","email"=>"fringilla.mi.lacinia@gravida.edu","password"=>"YJV82CVE7IP","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Oleg","lastname"=>"Dalton","email"=>"Quisque@tinciduntvehicularisus.net","password"=>"YIN93THR7WG","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Cameron","lastname"=>"Hood","email"=>"Cum.sociis@odioauctor.co.uk","password"=>"DIM67EWS4VG","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Davis","lastname"=>"Rivas","email"=>"orci.consectetuer@neque.edu","password"=>"VUK34NCC1VK","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Felix","lastname"=>"Coffey","email"=>"arcu.imperdiet.ullamcorper@nec.ca","password"=>"PFV85NXX7IN","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Reed","lastname"=>"Odonnell","email"=>"vel.vulputate@velfaucibusid.ca","password"=>"DAJ33YGT3XI","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Carson","lastname"=>"Oneill","email"=>"lobortis.mauris@lacusvarius.ca","password"=>"FSO12CGP8CA","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Nigel","lastname"=>"Fitzpatrick","email"=>"egestas@arcu.co.uk","password"=>"NEN91FCE8TF","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Mason","lastname"=>"Carter","email"=>"metus.Aenean@hendreritidante.ca","password"=>"LCT99LDJ6BW","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"August","lastname"=>"Singleton","email"=>"magna@est.com","password"=>"JLG20SNZ5JG","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Isaiah","lastname"=>"Marshall","email"=>"mauris@anteMaecenas.co.uk","password"=>"EGQ07YGD9QV","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Chase","lastname"=>"Ray","email"=>"facilisis@sodalesnisimagna.net","password"=>"DZN73UUH6KQ","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Keane","lastname"=>"Holt","email"=>"lobortis.risus.In@Vestibulum.com","password"=>"UPV77BNU9NM","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Bruce","lastname"=>"Roth","email"=>"Sed@eteros.com","password"=>"RXZ28LVN5GV","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Nigel","lastname"=>"Smith","email"=>"Mauris@Praesentluctus.net","password"=>"ZAC72CKC7LY","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Oleg","lastname"=>"Curtis","email"=>"nec@lectusrutrum.edu","password"=>"KFK45JZO6WT","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Melvin","lastname"=>"Hines","email"=>"Proin.velit.Sed@auguemalesuada.co.uk","password"=>"UEZ43UPD0PP","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Rajah","lastname"=>"Pate","email"=>"convallis.erat.eget@etmagnis.ca","password"=>"TKV92CXR7IR","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Chester","lastname"=>"Burgess","email"=>"orci@eget.edu","password"=>"YUE96AFA7NU","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Keane","lastname"=>"Francis","email"=>"volutpat.Nulla@ametfaucibus.net","password"=>"IAC55VWZ8PK","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Macaulay","lastname"=>"Arnold","email"=>"arcu.ac@aptenttacitisociosqu.ca","password"=>"ECQ01NOX3IL","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Gareth","lastname"=>"Stevenson","email"=>"Nam@atortorNunc.net","password"=>"DMN41YOA4OH","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Alfonso","lastname"=>"Church","email"=>"lectus@vehicula.org","password"=>"WGW24VER5YF","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Dexter","lastname"=>"Hampton","email"=>"sollicitudin.a.malesuada@luctusutpellentesque.net","password"=>"BNI09STZ4KZ","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Clinton","lastname"=>"Hardin","email"=>"rutrum.magna@elementumategestas.edu","password"=>"HDQ75AME1EU","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Joel","lastname"=>"Mccullough","email"=>"Nullam.nisl.Maecenas@Utsagittis.com","password"=>"OEX39GPE9ET","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Clayton","lastname"=>"Bolton","email"=>"pellentesque@sociosquadlitora.co.uk","password"=>"IHU41GSI6FN","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Jerry","lastname"=>"Wilder","email"=>"Aliquam@Maurismolestiepharetra.edu","password"=>"WUJ37KZP2FH","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Jeremy","lastname"=>"Garza","email"=>"nunc.risus.varius@ipsumSuspendisse.com","password"=>"ZWP68EXL4IT","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Kadeem","lastname"=>"Good","email"=>"blandit@metuseu.org","password"=>"OFA67TJP6QX","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Zephania","lastname"=>"Hansen","email"=>"non@pharetrased.com","password"=>"RLW76NAV2DN","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Abdul","lastname"=>"Emerson","email"=>"Donec@conguea.net","password"=>"WHE61QZJ6SU","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Henry","lastname"=>"Maddox","email"=>"ipsum.dolor@Aeneanmassa.com","password"=>"ACH37ZZO3EF","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Hu","lastname"=>"Ashley","email"=>"mauris.erat.eget@Namtempor.ca","password"=>"CZX42MGO5DA","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Rahim","lastname"=>"Solis","email"=>"elit.pretium.et@felis.co.uk","password"=>"GML30MZB7JP","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Rooney","lastname"=>"Holloway","email"=>"et.nunc.Quisque@commodo.org","password"=>"GUC30BQN6UT","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Timothy","lastname"=>"Holt","email"=>"Morbi@laoreetposuereenim.co.uk","password"=>"MBJ68KSA0XT","genre"=>"F",'roles'=>[],'birthday' => "1990-12-31"),
        // array("firstname"=>"Carlos","lastname"=>"Baker","email"=>"Donec.vitae.erat@et.com","password"=>"PIZ81WKQ4ZV","genre"=>"M",'roles'=>[],'birthday' => "1990-12-31"),
    ];

    /**
     * Password Encored
     *
     * @var UserPasswordHasherInterface
     */
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::DATA as $data)
        {
            $user = new User;
            
            $password = $this->hasher->hashPassword($user, $data['password']);

            $user->setFirstname( $data['firstname'] );
            $user->setLastname( $data['lastname'] );
            $user->setEmail( $data['email'] );
            $user->setPassword( $password );
            $user->setGenre( $data['genre'] );
            // $user->setRoles( $data['roles'] );
            $user->setBirthday( new \DateTime( $data['birthday'] ) );

            $manager->persist($user);
        }

        $manager->flush();
    }
}
