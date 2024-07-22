<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    const INTERESTS = [
        'music' => [
            'title' => 'Моя любимая музыка',
            'items' => [
                [
                    'name' => 'Apashe',
                    'description' => 'Lord & Master',
                    'audio' => 'music/Apashe-Lord&Master.mp3',
                    'image' => 'images/LORD & MASTER.jpg',
                ],
                [
                    'name' => 'Apashe',
                    'description' => 'Work',
                    'audio' => 'music/Apashe-Work.mp3',
                    'image' => 'images/Apashe-Work.jpg',

                ],
                [
                    'name' => 'Indila',
                    'description' => 'Parle a ta tete',
                    'audio' => 'music/Indila-Parle a ta tete.mp3',
                    'image' => 'images/PARLE A TA TETE.jpg',

                ],
                [
                    'name' => 'Lil Nas X',
                    'description' => 'INDUSTRY BABY',
                    'audio' => 'music/Lil Nas X-INDUSTRY BABY.mp3',
                    'image' => 'images/INDUSTRY BABY.jpg',
                ],
                [
                    'name' => 'Stromae',
                    'description' => 'Carmen',
                    'audio' => 'music/Stromae-Carmen.mp3',
                    'image' => 'images/CARMEN.jpg',
                ],
                [
                    'name' => 'Tiesto',
                    'description' => 'Seavolution',
                    'audio' => 'music/Tiesto-Seavolution.mp3',
                    'image' => 'images/SEAVOLUTION.jpg',
                ],

            ],
        ],

        'hobby' => [
            'title' => 'Мое хобби',
            'items' => [
                [
                    'name' => 'Готовка',
                    'description' => 'Иногда я люблю готовить для родных и близких.',
                    'image' => 'images/готовка.jpg',
                ],
                [
                    'name' => 'Инвестирование',
                    'description' => 'И даже инвестировать.',
                    'image' => 'images/инвестирование.jpg',
                ],
                [
                    'name' => 'Слушать музыку',
                    'description' => 'Но больше всего я люблю слушать хорошую музыку.',
                    'image' => 'images/музыка.jpg',
                ],
            ],
        ],

        'games' => [
            'title' => 'Мои любимые игры',
            'items' => [
                [
                    'name' => 'Prime World',
                    'description' => 'Одна из первых игр моего детства, в которую я играл со своими друзьями по Скайпу. 31 марта 2021 года проект был закрыт.',
                    'image' => 'images/prime_world.jpg',
                ],
                [
                    'name' => 'Grand Theft Auto',
                    'description' => 'Одна из игр, в которую хочется зайти и сегодня.',
                    'image' => 'images/gta.jpg',
                ],
                [
                    'name' => 'Warface',
                    'description' => 'И конечно же, куда без шутеров. Тот самый шутер, в которрый я начинал играть молодым, а закончу старым.',
                    'image' => 'images/warface.jpg',
                ],
            ],
        ],

        'movies' => [
            'title' => 'Мои любимые фильмы',
            'items' => [
                [
                    'name' => 'Marvel',
                    'description' => 'Одна из самых затягивающих киновселенных.',
                    'image' => 'images/marvel.jpg',
                ],
                [
                    'name' => 'Harry Potter',
                    'description' => 'Это история о юном волшебнике, бросившем вызов Темному Лорду — воплощению самой Смерти.',
                    'image' => 'images/HP.jpg',
                ],
                [
                    'name' => 'Lord of the Rings',
                    'description' => 'О приключениях хоббитов, волшебников, гномов, людей и эльфов, ну вы поняли.',
                    'image' => 'images/LofR.jpg',
                ],
            ],
        ],

    ];


}
