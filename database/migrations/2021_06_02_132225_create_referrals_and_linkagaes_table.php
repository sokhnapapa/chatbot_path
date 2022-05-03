<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralsAndLinkagaesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals_and_linkagaes', function (Blueprint $table) {
            $table->increments('id');
            $table->text('facility_name')->nullable();;
            $table->text('level')->nullable();;
            $table->text('district')->nullable();;
            $table->timestamps();
        });
        $sql = <<<SQL
        INSERT INTO `referrals_and_linkagaes` (`id`, `facility_name`, `level`, `district`) VALUES
        (1,  'TASO Kanyanya', 'AIDS Clinic', 'Kampala'),
        (2,  'TASO Mulago', 'AIDS Clinic', 'Kampala'),
        (3,  'Mulago CDC', 'AIDS Clinic', 'Kampala'),
        (4,  'Mujhu Resea Co', 'AIDS Clinic', 'Kampala'),
        (5,  'Mulago ISS', 'NRH', 'Kampala'),
        (6,  'Mulago TB-HIV', 'AIDS Clinic', 'Kampala'),
        (7,  'Mulago TB-HIV', 'AIDS Clinic', 'Kampala'),
        (8,  'Post Natal Clinic', 'AIDS Clinic', 'Kampala'),
        (9,  'Kampala Dispen', 'Health Center II', 'Kampala'),
        (10, 'PIDC Ward', 'AIDS Clinic', 'Kampala'),
        (11, 'TASO Entebbe', 'AIDS Clinic', 'Wakiso'),
        (12, 'Medical Res Coun', 'AIDS Clinic', 'Wakiso'),
        (13, 'Entebbe Grade B', 'AIDS Clinic', 'Wakiso'),
        (14, 'Kisubi Hospital', 'AIDS Clinic', 'Wakiso'),
        (15, 'Katabi Hospital', 'AIDS Clinic', 'Wakiso'),
        (16, 'Saidina Abubaker', 'AIDS Clinic', 'Wakiso'),
        (17, 'Buwambo Health Center', 'Health Center IV', 'Wakiso'),
        (18, 'Namayumba Health Center', 'Health Center IV', 'Wakiso'),
        (19, 'Ndejje Health Center', 'Health Center IV', 'Wakiso'),
        (20, 'Waksio Health Center', 'Health Center IV', 'Wakiso'),
        (21, 'Mildmay Hospital', 'AIDS Clinic', 'Kampala'),
        (22, 'Wagagai Clinic', 'Clinic', 'Wakiso'),
        (23, 'Nagalama', 'Hospital', 'Mukono'),
        (24, 'Kojja Health Center', 'Health Center IV', 'Mukono'),
        (25, 'Mukono COU HC', 'Health Center IV', 'Mukono'),
        (26, 'Mukono Health Center', 'Health Center IV', 'Mukono'),
        (27, 'Kyetume Center', 'Health Center III', 'Mukono'),
        (28, 'Royal VanZan Ten', 'Clinic', 'Mukono'),
        (29, 'Family Hope Cent', 'AIDS Clinic', 'Mukono'),
        (30, 'Kyambogo University', 'Health Center IV', 'Kampala'),
        (31, 'Kyadondo Medical Center', 'Clinic', 'Kampala'),
        (32, 'Kawempe Health Center', 'AIDS Clinic', 'Kampala'),
        (33, 'Kisenyi Health Center', 'Health Center IV', 'Kampala'),
        (34, 'Murchsion Bay', 'Hospital', 'Kampala'),
        (35, 'Gen Mil Mbuya', 'Hospital', 'Kampala'),
        (36, 'Nsambya General Clinic', 'Clinic', 'Kampala'),
        (37, 'Nsambya Privat Wing', 'Hospital', 'Kampala'),
        (38, 'Nsambya Police Hospital', 'Hospital', 'Kampala'),
        (39, 'Makerere University', 'Hospital', 'Kampala'),
        (40, 'Mengo Hospital', 'Hospital', 'Kampala'),
        (41, 'Namungoona Hospital', 'Hospital', 'Kampala'),
        (42, 'Wagagai Clinic', 'Clinic', 'Wakiso'),
        (43, 'Kabubu', 'Health Center II', 'Wakiso'),
        (44, 'Namugongo Child', 'Clinic', 'Wakiso'),
        (45, 'Touch Namuwon', 'Clinic', 'Wakiso'),
        (46, 'Roofing Facility', 'Clinic', 'Wakiso'),
        (47, 'Kakiri 1st Div Military', 'Hospital', 'Wakiso'),
        (48, 'MasaJja Nursing', 'Clinic', 'Wakiso'),
        (49, 'Tropical Clinic', 'Clinic', 'Wakiso'),
        (50, 'Kibuli Hospital', 'Hospital', 'Kampala');
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
        Schema::dropIfExists('referrals_and_linkagaes');
    }
}
