<?php

namespace Database\Seeders;

use App\Models\Set;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $sets = [
        //     [
        //         'name' => 'Introduction to Backend Development',
        //         'course_id' => 5,
        //         'order' => 0
        //     ],
        //     [
        //         'name' => 'Programming Foundations',
        //         'course_id' => 5,
        //         'order' => 1
        //     ],
        //     [
        //         'name' => 'Database Management',
        //         'course_id' => 5,
        //         'order' => 2
        //     ],
        //     [
        //         'name' => 'Building RESTful APIs',
        //         'course_id' => 5,
        //         'order' => 3
        //     ],
        //     [
        //         'name' => 'Introduction to Frontend Frameworks',
        //         'course_id' => 6,
        //         'order' => 0
        //     ],
        //     [
        //         'name' => 'Setting Up the Environment',
        //         'course_id' => 6,
        //         'order' => 1
        //     ],
        //     [
        //         'name' => 'HTML and CSS Refresher',
        //         'course_id' => 6,
        //         'order' => 2
        //     ],
        //     [
        //         'name' => 'React Basics',
        //         'course_id' => 6,
        //         'order' => 3
        //     ],
        //     [
        //         'name' => 'Testing Frontend Applications',
        //         'course_id' => 6,
        //         'order' => 4
        //     ],
        //     [
        //         'name' => 'Introduction to Dynamic Web Applications',
        //         'course_id' => 7,
        //         'order' => 0
        //     ],
        //     [
        //         'name' => 'Understanding the Client-Server Model',
        //         'course_id' => 7,
        //         'order' => 1
        //     ],
        //     [
        //         'name' => 'Server-Side Scripting Basics',
        //         'course_id' => 7,
        //         'order' => 2
        //     ],
        //     [
        //         'name' => 'Database Integration',
        //         'course_id' => 7,
        //         'order' => 3
        //     ],
        //     [
        //         'name' => 'Introduction to Progressive Web Apps',
        //         'course_id' => 8,
        //         'order' => 0
        //     ],
        //     [
        //         'name' => 'Web App Basics',
        //         'course_id' => 8,
        //         'order' => 1
        //     ],
        //     [
        //         'name' => 'Service Workers Fundamentals',
        //         'course_id' => 8,
        //         'order' => 2
        //     ],
        //     [
        //         'name' => 'Application Shell Architecture',
        //         'course_id' => 8,
        //         'order' => 3
        //     ],
        //     [
        //         'name' => 'Caching Strategies with Service Workers',
        //         'course_id' => 8,
        //         'order' => 4
        //     ],
        //     [
        //         'name' => 'Introduction to Web Security',
        //         'course_id' => 9,
        //         'order' => 0
        //     ],
        //     [
        //         'name' => 'Understanding Common Threats',
        //         'course_id' => 9,
        //         'order' => 1
        //     ],
        //     [
        //         'name' => 'The HTTP Protocol and Security Basics',
        //         'course_id' => 9,
        //         'order' => 2
        //     ],
        // ];
        
        // foreach ($sets as $set) {
        //     Set::create($set);
        // }

        $lessons = [
            [
                'name' => 'Overview of Backend Development',
                'order' => 0,
                'set_id' => 13
            ],
            [
                'name' => 'Understanding Backend vs Frontend',
                'order' => 1,
                'set_id' => 13
            ],
            [
                'name' => 'Backend Developer Tools',
                'order' => 2,
                'set_id' => 13
            ],
        
            [
                'name' => 'Introduction to Programming',
                'order' => 0,
                'set_id' => 14
            ],
            [
                'name' => 'Data Types and Variables',
                'order' => 1,
                'set_id' => 14
            ],
            [
                'name' => 'Control Structures',
                'order' => 2,
                'set_id' => 14
            ],
            [
                'name' => 'Functions and Modularization',
                'order' => 3,
                'set_id' => 14
            ],
        
            [
                'name' => 'Introduction to Databases',
                'order' => 0,
                'set_id' => 15
            ],
            [
                'name' => 'SQL Basics',
                'order' => 1,
                'set_id' => 15
            ],
            [
                'name' => 'Database Design Principles',
                'order' => 2,
                'set_id' => 15
            ],
            [
                'name' => 'Using Database Management Systems',
                'order' => 3,
                'set_id' => 15
            ],
        
            [
                'name' => 'Introduction to REST',
                'order' => 0,
                'set_id' => 16
            ],
            [
                'name' => 'Setting Up a REST API',
                'order' => 1,
                'set_id' => 16
            ],
            [
                'name' => 'CRUD Operations in REST',
                'order' => 2,
                'set_id' => 16
            ],
            [
                'name' => 'REST API Authentication',
                'order' => 3,
                'set_id' => 16
            ],
        
            [
                'name' => 'What is a Frontend Framework?',
                'order' => 0,
                'set_id' => 17
            ],
            [
                'name' => 'Benefits of Using Frontend Frameworks',
                'order' => 1,
                'set_id' => 17
            ],
            [
                'name' => 'Popular Frontend Frameworks',
                'order' => 2,
                'set_id' => 17
            ],
        
            [
                'name' => 'Installing Development Tools',
                'order' => 0,
                'set_id' => 18
            ],
            [
                'name' => 'Configuring Your Environment',
                'order' => 1,
                'set_id' => 18
            ],
        
            [
                'name' => 'Introduction to HTML',
                'order' => 0,
                'set_id' => 19
            ],
            [
                'name' => 'CSS Basics and Styling',
                'order' => 1,
                'set_id' => 19
            ],
        
            [
                'name' => 'Introduction to React',
                'order' => 0,
                'set_id' => 20
            ],
            [
                'name' => 'Understanding Components',
                'order' => 1,
                'set_id' => 20
            ],
            [
                'name' => 'State and Props in React',
                'order' => 2,
                'set_id' => 20
            ],
        
            [
                'name' => 'Why Testing Matters',
                'order' => 0,
                'set_id' => 21
            ],
            [
                'name' => 'Introduction to Unit Testing',
                'order' => 1,
                'set_id' => 21
            ],
        
            [
                'name' => 'Dynamic Content Basics',
                'order' => 0,
                'set_id' => 22
            ],
            [
                'name' => 'Connecting to APIs',
                'order' => 1,
                'set_id' => 22
            ],
            [
                'name' => 'Rendering Data Dynamically',
                'order' => 2,
                'set_id' => 22
            ],
        
            [
                'name' => 'What is a Progressive Web App?',
                'order' => 0,
                'set_id' => 23
            ],
            [
                'name' => 'Service Workers Overview',
                'order' => 1,
                'set_id' => 23
            ],
            [
                'name' => 'Building Offline-Ready Apps',
                'order' => 2,
                'set_id' => 23
            ],
        
            [
                'name' => 'Common Web Vulnerabilities',
                'order' => 0,
                'set_id' => 24
            ],
            [
                'name' => 'Securing User Input',
                'order' => 1,
                'set_id' => 24
            ],
            [
                'name' => 'Understanding HTTPS',
                'order' => 2,
                'set_id' => 24
            ]
        ];
        
        foreach ($lessons as $lesson) {
            Lesson::create($lesson);
        }
        
        
    }
}
