<?php

use App\Enums\ProjectVisibility;
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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('sku')->nullable();
            $table->foreignId('creator_id')->index()->nullable();
            $table->decimal('total_earned', 10, 2)->default(0);
            $table->decimal('total_wanted', 10, 2)->default(0);
            $table->foreignId('project_status_id')->index()->nullable();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->boolean('featured')->default(false);
            $table->string('thumbnail')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->tinyInteger('order')->nullable();
            $table->enum('visibility', array_column(ProjectVisibility::cases(), 'value'));
            $table->boolean('accept_donation')->default(false);
            $table->boolean('show_in_home_page')->default(false);
            $table->boolean('show_in_shop')->default(false);
            $table->boolean('is_gift')->default(false);
            $table->foreignId('category_id')->index()->nullable();
            $table->foreignId('sub_category_id')->index()->nullable();
            // مفعل
            $table->boolean('active')->default(false);
            // عرض في القائمة
            $table->boolean('show_in_menu')->default(false);
            // مخفي
            $table->boolean('hidden')->default(false);
            // التبرع متاح
            $table->boolean('donation_available')->default(false);
            // الدولة
            $table->foreignId('country_id')->index()->nullable();
            // عرض التعليق على التبرع
            $table->boolean('show_donation_comment')->default(false);
            // اكتب النص
            $table->string('donation_comment')->nullable();
            // هذا التبرع زكاه مال ؟
            $table->boolean('is_zakat')->default(false);
            // عرض رقم هاتف المتبرع
            $table->boolean('show_donor_phone')->default(false);
            // رقم الهاتف اجباري؟
            $table->boolean('donor_phone_required')->default(false);
            // عرض اسم المتبرع
            $table->boolean('show_donor_name')->default(false);
            // اسم المتبرع اجباري؟
            $table->boolean('donor_name_required')->default(false);
            // عرض البانر
            $table->boolean('show_banner')->default(false);
            // مستمر
            $table->boolean('is_continuous')->default(false);
            // وحدة كاملة
            $table->boolean('is_full_unit')->default(false);
            // متعدد الدول
            $table->boolean('is_multi_country')->default(false);
            // مخزن
            $table->boolean('is_stock')->default(false);
            // تبرع سريع
            $table->boolean('is_quick_donation')->default(false);
            // قيمة الوحدة
            $table->decimal('unit_value', 10, 2)->nullable();
            // مخزن
            $table->decimal('stock', 10, 2)->nullable();
            // اظهار التايمر
            $table->boolean('show_timer')->default(false);
            // اظهار المبلغ المستهدف
            $table->boolean('show_target_amount')->default(false);
            // اظهار المبلغ المدفوع
            $table->boolean('show_paid_amount')->default(false);
            // اظهار النسبة
            $table->boolean('show_percentage')->default(false);
            // الصورة الرئيسية
            $table->string('main_image')->nullable();
            // الصورة البانر
            $table->string('banner_image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
