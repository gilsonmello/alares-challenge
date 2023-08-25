<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\MeasureEnum;
use App\Enums\StatusNameEnum;
use App\Enums\TimeIntervalEnum;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        [$customer1, $customer2, $customer3] = \App\Models\Customer::factory(3)->create();

        $paramount = \App\Models\App::create([
            'name' => 'Paramount+',
            'img_src' => 'https://alaresinternet.com.br/wp-content/uploads/2023/01/paramount_logo-300x187-1.png'
        ]);
        $mcafee = \App\Models\App::create([
            'name' => 'McAfee',
            'img_src' => 'https://alaresinternet.com.br/wp-content/uploads/2023/01/McAfee_logo.svg.png'
        ]);
        $contaOutraVezMini = \App\Models\App::create([
            'name' => 'Conta outra vez mini',
            'img_src' => 'https://alaresinternet.com.br/wp-content/uploads/2023/01/conta-Outra-Vez-Mini.png'
        ]);
        $skeelo = \App\Models\App::create([
            'name' => 'Skeelo',
            'img_src' => 'https://alaresinternet.com.br/wp-content/uploads/2023/01/skeelo-2.png'
        ]);
        $revistasJa = \App\Models\App::create([
            'name' => 'Revistas ja',
            'img_src' => 'https://alaresinternet.com.br/wp-content/uploads/2023/01/revistas.png'
        ]);
        $leveEduca = \App\Models\App::create([
            'name' => 'Revistas ja',
            'img_src' => 'https://alaresinternet.com.br/wp-content/uploads/2023/01/LEV.png'
        ]);
        $bitTrainer = \App\Models\App::create([
            'name' => 'Revistas ja',
            'img_src' => 'https://alaresinternet.com.br/wp-content/uploads/2023/01/Logo-nova-bitttrainer.png'
        ]);

        $giga2 = \App\Models\Plan::create([
            'qty' => '2',
            'measure' => MeasureEnum::GIGA->value,
            'time_interval' => TimeIntervalEnum::MONTHLY,
            'price' => 399.99
        ]);
        $giga1 = \App\Models\Plan::create([
            'qty' => '1',
            'measure' => MeasureEnum::GIGA->value,
            'time_interval' => TimeIntervalEnum::MONTHLY,
            'price' => 99.99,
            'is_better' => true
        ]);
        $giga1_5 = \App\Models\Plan::create([
            'qty' => '1.5',
            'measure' => MeasureEnum::GIGA->value,
            'time_interval' => TimeIntervalEnum::MONTHLY,
            'price' => 149.99
        ]);

        $wifi = \App\Models\PlanFeature::create([
            'name' => 'Super Wi-Fi 6'
        ]);
        $instalation = \App\Models\PlanFeature::create([
            'name' => 'Instalação'
        ]);
        $download = \App\Models\PlanFeature::create([
            'name' => 'Download'
        ]);
        $upload = \App\Models\PlanFeature::create([
            'name' => 'Upload'
        ]);
        $apps = \App\Models\PlanFeature::create([
            'name' => 'Apps de conteúdo'
        ]);
        $giga2->contentApps()->attach([
            $paramount->id, $mcafee->id, $bitTrainer->id,
        ], []);
        $giga2->features()->attach(
            [
                $wifi->id,
                $instalation->id,
                $download->id,
                $upload->id,
                $apps->id
            ]
        );

        $giga1->contentApps()->attach([
            $leveEduca->id,
            $contaOutraVezMini->id,
            $skeelo->id,
            $revistasJa->id,
        ], []);
        $giga1->features()->attach(
            [
                $wifi->id,
                $instalation->id,
                $download->id,
                $upload->id,
                $apps->id
            ]
        );

        $giga1_5->contentApps()->attach([
            $paramount->id,
            $mcafee->id,
            $bitTrainer->id
        ], []);
        $giga1_5->features()->attach(
            [
                $wifi->id,
                $instalation->id,
                $download->id,
                $upload->id,
                $apps->id
            ]
        );

        \App\Models\Order::create([
            'status_name' => StatusNameEnum::IN_PROGRESS,
            'customer_id' => $customer1->id,
            'plan_id' => $giga2->id
        ]);

        \App\Models\Order::create([
            'status_name' => StatusNameEnum::IN_PROGRESS,
            'customer_id' => $customer2->id,
            'plan_id' => $giga1->id
        ]);

        \App\Models\Order::create([
            'status_name' => StatusNameEnum::IN_PROGRESS,
            'customer_id' => $customer3->id,
            'plan_id' => $giga1_5->id
        ]);
    }
}
