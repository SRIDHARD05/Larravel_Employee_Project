<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();  // UUID for primary key
            $table->string('type');          // Notification type (class name)
            $table->uuid('notifiable_id');   // The ID of the notifiable (user)
            $table->string('notifiable_type');  // The type of the notifiable model (User, etc.)
            $table->text('data');            // The notification data (json)
            $table->timestamp('read_at')->nullable();  // When the notification was read
            $table->timestamps();           // Created and updated timestamps
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
