   */
    <?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;
    
    class AddSoftDeletesToTeams extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('Socsos', function($table) {
                $table->timestamps();
                 $table->softDeletes();
            });
            Schema::table('Security_groups', function($table) {
          
                 $table->softDeletes();
            });
        }
    
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('Socsos', function($table) {
                $table->dropColumn('timestamps');
                $table->softDeletes();
            });
            Schema::table('Security_groups', function($table) {
        
                $table->softDeletes();
            });
        }
    }
    