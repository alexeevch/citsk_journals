<?php

namespace Database\Seeders;

use App\Models\IncidentType;
use Illuminate\Database\Seeder;

class IncidentTypeSeeder extends Seeder
{

    public function run(): void
    {
        $incidentTypes = [
            [
                "name"        => "Фишинг",
                "description" => "Вид интернет-мошенничества, целью которого является получение доступа к конфиденциальным данным пользователей - логинам и паролям."
            ],
            [
                "name"        => "Вирусная атака",
                "description" => "Заражение компьютера вредоносным программным обеспечением, которое может красть данные, шифровать файлы или использовать ресурсы ПК для майнинга криптовалюты."
            ],
            [
                "name"        => "Атака типа 'отказ в обслуживании' (DDoS)",
                "description" => "Вывод из строя сайта или сервиса путем создания большого количества запросов с разных источников."
            ],
            [
                "name"        => "Взлом паролей",
                "description" => "Получение несанкционированного доступа к системе путем подбора или кражи учетных данных."
            ],
            [
                "name"        => "Инъекция SQL",
                "description" => "Внедрение вредоносного SQL-кода в запросы к базе данных с целью получения доступа к конфиденциальной информации."
            ],
            [
                "name"        => "Кража данных",
                "description" => "Несанкционированный доступ к базам данных и хищение персональной, финансовой или коммерческой информации."
            ],
            [
                "name"        => "Шифровальщик (Ransomware)",
                "description" => "Вид вредоносного ПО, шифрующего файлы на компьютере и требующего выкуп за расшифровку."
            ],
            [
                "name"        => "Майнинг криптовалюты",
                "description" => "Использование ресурсов чужих компьютеров для добычи криптовалюты без ведома и согласия владельцев."
            ],
            [
                "name"        => "Кража личности",
                "description" => "Использование персональных данных человека для получения кредитов, оформления документов или совершения других противоправных действий."
            ],
            [
                "name"        => "Атака на цепочку поставок",
                "description" => "Внедрение вредоносного ПО в программное обеспечение или оборудование на этапе разработки или доставки."
            ]
        ];

        IncidentType::insert($incidentTypes);
    }
}
