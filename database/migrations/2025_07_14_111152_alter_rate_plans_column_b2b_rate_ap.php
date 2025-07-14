    <?php

    use Dompdf\FrameDecorator\Table;
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::table('rate_plans', function (Blueprint $table) {
                //

                $table->decimal('b2b_rate_ap', 10, 2)->default(0)->after('b2b_rate_map');
                $table->decimal('markup_ap', 10, 2)->default(0)->after('markup_map');
                $table->decimal('total_amount_ap', 10, 2)->default(0)->after('total_amount_map');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('rate_plans', function (Blueprint $table) {

                $table->dropColumn('b2b_rate_ap');
                $table->dropColumn('markup_ap');
                $table->dropColumn('total_amount_ap');
            });
        }
    };
