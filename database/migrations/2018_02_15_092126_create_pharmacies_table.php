<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmaciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('facility_name', 200);
            $table->string('village', 200);
            $table->string('sub_county', 100);
            $table->string('district', 100);
            $table->string('contact_name', 100);
            $table->string('phone_number', 100);
            $table->double('lat')->nullable();
            $table->double('lon')->nullable();
            //$table->timestamps();
        });

        $sql = <<<SQL
            INSERT INTO `pharmacies` (`id`, `facility_name`, `village`, `sub_county`, `district`,`contact_name`, `phone_number`, `lat`, `lon`) VALUES
            (1, 'Makindye Health Center III', 'Makindye', 'Makindye Division','Kampala','Samuel Angweo', '0777212472', '0.2863815', '32.5803188'),
            (2, 'Makerere University Hospital', 'Makerere', 'Central Division','Kampala','Sister Elizabeth', '0757714147', '0.3281950', '32.5705492'),
            (3, 'Kojja Health Center IV', 'Ntenjeru', 'Ntenjeru Division','Mukono','Kigoonya Ronald', '0787950141', '0.2863815', '32.5803188'),
            (4, 'Mpunge Health Center III', 'Mpunge', 'Mpunge Division','Mukono','Madrine Dachiru', '0777212472', '0.1222929', '32.7216089'),
            (5, 'Katoogo Health Center III', 'Katoogo', 'Nam','Mukono','Nambeera Betty', '07782478453', '0.4470401', '32.8180042'),
            (6, 'Kyengera Health Center III', 'Kyengera', 'Nsangi','Wakiso','Namboozi Betty', '0772347114', '0.2971465', '32.4995112'),
            (7, 'Maganjo Health Center II', 'Maganjo', 'Nabweru','Wakiso','Grace Nakayi', '0772915576', '0.3906180', '32.5479322'),
            (8, 'Kiganda Maternity Home', 'Kawempe', 'Kawempe','Kampala','Namubiru Elizabeth', '0777518016', '0.3906180', '32.5479322'),
            (9, 'Kalen Clinic', 'Mubaraka', 'Makindye Division','Kampala','Namaliru Phiona', '0700144881', '0.3906180', '32.5479322'),
            (10, 'Tinka Access Clinic', 'Ggaba', 'Makindye Division','Kampala','Nemigisha Anitarace', '0702866617', '0.3906180', '32.5479322'),
            (11, 'Consult Clinic Kisasi', 'Kisasi', 'Central Division','Kampala','Kintu M', '0702833441', '0.3906180', '32.5479322'),
            (12, 'Kawoya Foundation Clinic', 'Kasabla', 'Mukono Central','Mukono','Kalule Hamisi', '0753672263', '0.3906180', '32.5479322'),
            (13, 'St Francis Medical Center', 'Mukono Municipal', 'Mukono Municipal','Mukono','Bussulwa Tonny', '0775595046', '0.3906180', '32.5479322'),
            (14, 'St John Health Center', 'Gulu', 'Mukono Municipal','Mukono','Namaganda Halima', '0706306267', '0.3906180', '32.5479322'),
            (15, 'Hilgrem Medical Center', 'Wantoni', 'Mukono Municipal','Mukono','Namutebi Lydia', '0706400389', '0.3906180', '32.5479322'),
            (16, 'Peoples Medical Center', 'Gayaza', 'Kasangati Town Concil','Wakiso','Christine', '0759589862', '0.3906180', '32.5479322'),
            (17, 'Doctors Medical Center', 'Banda', 'Banda Kyambogo','Wakiso','Bwambale Edgar', '0788636109', '0.3906180', '32.5479322'),
            (18, 'Herm Medical Center', 'Maganjo', 'Nabweru','Wakiso','Nagawa Joanita', '0753995101', '0.3906180', '32.5479322'),
            (19, 'Victorious Medical Center', 'Maganjo', 'Nabweru','Wakiso','Patience Tukundane', '0786286984', '0.3906180', '32.5479322'),
            (20, 'Mpereza Clinic', 'Kasenyi', 'Katabi','Wakiso','NAVA HADIJJA', '0753791753', '0.3906180', '32.5479322'),
            (21, 'Medical Link', 'Nkumba', 'Katabi','Wakiso','Dr Denis Waswa', '0774392428', '0.3906180', '32.5479322'),
            (22, 'Entebbe Central Clinic', 'Lunyo East', 'Nabweru','Wakiso','Kwesiga Alfred', '0776327998', '0.3906180', '32.5479322'),
            (23, 'Hefra Pharmacy', 'Bugolobi', 'Nakawa Division','Kampala','Micheal Kaija', '0759219716', '0.3906180', '32.5479322'),
            (24, 'Lisa Pharmacy', 'Kabalagala', 'Kabalagala','Kampala','Joseph Kanakulya', '0787625454', '0.3906180', '32.5479322'),
            (25, 'Guardian Health Pharmacy', 'Kansanga', 'Kansanga','Kampala','JNamugumya D', '0778139724', '0.3906180', '32.5479322'),
            (26, 'Revigen Pharmacy', 'Makerere', 'Makerere Western Gate','Kampala','Ainembabazi Ruth', '0779653063', '0.3906180', '32.5479322'),
            (27, 'Goreals Pharmaceuticals LTD', 'Kasubi Kawaala', 'Central Division','Kampala','Outa Sixtus', '0759754196', '0.3906180', '32.5479322'),
            (28, 'Cedars Pharmacy', 'Nankulabye', 'Central Division','Kampala','Joan Kyagulanyi', '0703932908', '0.3906180', '32.5479322'),
            (29, 'Luwadde Pharmacy', 'UCU', 'Mukono Central','Mukono','Nakafero Joyce', '0703863693', '0.3906180', '32.5479322'),
            (30, 'Al Noor Pharmaceuticals', 'Wantoni', 'Mukono Central','Mukono','Aperuno Christine', '0772185922', '0.3906180', '32.5479322'),
            (31, 'Jaspharm Pharmacy', 'Kireka', 'Bweyogere','Wakiso','James Jobi', '0702713262', '0.3906180', '32.5479322'),
            (32, 'General Topcare Pharmacy', 'Nsangi', 'Nsangi','Waksio','Mujumbi Jamir', '0753897714', '0.3906180', '32.5479322'),
            (33, 'Healthplus Pharm LTD', 'Kyengera', 'Kyengera','Wakiso','Asiimwe Vanita', '0783509840', '0.3906180', '32.5479322'),
            (34, 'VERSE PHARMACY', 'Lweza', 'Kajjansi Town Council','Wakiso','Kalibala Isaac', '0758070189', '0.3906180', '32.5479322'),
            (35, 'JOSANA PHARMACY', 'NABINGO', 'KYENGERA Town Concil','Wakiso','SSENTAMU SARAH', '0753688714', '0.3906180', '32.5479322'),
            (36, 'Saint Pharmacy', 'Kitoro', 'Entebbe Division B','Wakiso','Maria Alihona', '0772891376', '0.3906180', '32.5479322'),
            (37, 'Kasangati Health Center IV', 'Kasangati', 'Kasangati Town Concil','Wakiso','Sr Kaujo A', '0701898094', '0.2863815', '32.5803188');
        SQL;
        
        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pharmacies');
    }
}
