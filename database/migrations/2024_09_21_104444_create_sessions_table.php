    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateSessionsTable extends Migration
    {
        public function up(): void
        {
            Schema::create('sessions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('client_id')->constrained()->onDelete('cascade');
                $table->string('session_type');
                $table->string('session_number');
                $table->string('opponent_name');
                $table->date('session_date');
                $table->enum('session_status', ['سارية', 'محفوظة']);
                $table->mediumText('notes')->nullable();
                $table->timestamps();
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('sessions');
        }
    }
