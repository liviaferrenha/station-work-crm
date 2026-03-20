public function up()
{
    Schema::create('vendedores', function (Blueprint $table) {
        $table->id();

        $table->string('name');
        $table->string('email');

        $table->integer('queue_position')->default(0);
        $table->boolean('active')->default(true);

        $table->timestamps();
    });
}