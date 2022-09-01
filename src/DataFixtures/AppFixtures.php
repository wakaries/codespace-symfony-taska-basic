<?php

namespace App\DataFixtures;

use App\Entity\Epic;
use App\Entity\Project;
use App\Entity\Release;
use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Nelmio\Alice\Loader\NativeLoader;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $loader = new NativeLoader();
        $data = $loader->loadData([
            Project::class => [
                'project{1..10}' => [
                    'alias (unique)' => '<bothify(???-####)>',
                    'name' => '<colorName()>',
                    'status' => 1,
                    'description' => '<paragraph()>'
                ]
            ],
            Epic::class => [
                'epic{1..100}' => [
                    'project' => '@project*',
                    'alias (unique)' => '<bothify(???-####)>',
                    'title' => '<sentence()>',
                    'status' => '<randomElement([todo, standby, inprogress, done])>',
                    'description' => '<text()>'
                ]
            ],
            Release::class => [
                'release{1..30}' => [
                    'project' => '@project*',
                    'startDate' => '<dateTime()>',
                    'name' => '<semver()>',
                    'status' => 1
                ]
            ],
            Task::class => [
                'task{1..500}' => [
                    'epic' => '@epic*',
                    'type' => 'task',
                    'creationDate' => '<dateTime()>',
                    'alias (unique)' => '<bothify(???-####)>',
                    'title' => '<sentence()>',
                    'status' => '<randomElement([todo, inprogress, done])>',
                    'description' => '<text()>'
                ]
            ]
        ]);

        foreach ($data->getObjects() as $item) {
            $manager->persist($item);
        }

        $manager->flush();
    }
}
