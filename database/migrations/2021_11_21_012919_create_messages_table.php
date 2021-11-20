<?php

use App\Models\Message;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(with(new Message)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->bigInteger('sender_id');
            $table->bigInteger('receiver_id');
            $table->tinyInteger('is_read')->default(0);
            $table->timestamps();
        });

        $data = [
            ['message' => 'Hi','sender_id' => 1,'receiver_id' => 4],
            ['message' => 'Hi','sender_id' => 2,'receiver_id' => 4],
            ['message' => 'Hi','sender_id' => 3,'receiver_id' => 4],
            ['message' => 'Hi','sender_id' => 1,'receiver_id' => 2],
            ['message' => 'Hi','sender_id' => 4,'receiver_id' => 2],
            ['message' => 'Hi','sender_id' => 3,'receiver_id' => 2],
            ['message' => 'Hi','sender_id' => 1,'receiver_id' => 3],
            ['message' => 'Hi','sender_id' => 2,'receiver_id' => 3],
            ['message' => 'Hi','sender_id' => 4,'receiver_id' => 3],
        ];

        Message::insert($data);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(with(new Message)->getTable());
    }
}
