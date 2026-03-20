public function up()
{
    Schema::create('leads', function (Blueprint $table) {
        $table->id();

        $table->string('name');
        $table->string('email')->nullable();
        $table->string('phone')->nullable();

        $table->string('status')->nullable();
        $table->string('source')->nullable();
        $table->integer('probability')->nullable();
        $table->decimal('expected_revenue', 10, 2)->nullable();

        $table->string('company_name')->nullable();
        $table->string('company_address')->nullable();
        $table->string('job_title')->nullable();
        $table->text('notes')->nullable();

        $table->unsignedBigInteger('vendedor_id')->nullable();

        $table->timestamps();
    });
}