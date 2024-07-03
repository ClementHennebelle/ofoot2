<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Club;
use App\Entity\Tournament;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $clubObjectList = $this->loadClubs($manager);
        $tournamentObjectList = $this->loadTournaments($manager);
    } 
    private function loadTournaments (ObjectManager $manager) {
        $tournaments = [
            'name' => 'Tournoi du FC Paris',
            'date' => '2024-04-04',
            'price' => '15',
            'rewards' => 'trophée',
            'nombre équipes'=> '16',
            'nombre joueurs' => '12',
            'location' => 'Paris',
            'Poster' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.science-et-vie.com%2Fscience-et-culture%2Fqui-etait-ragnar-lothbrok-130245.html&psig=AOvVaw3HwLxJvo0ikemJg-eTljm7&ust=1720085608912000&source=images&cd=vfe&opi=89978449&ved=0CA8QjRxqFwoTCMjwuq_IiocDFQAAAAAdAAAAABAE',
            'created_at' => '2024-07-03'];
            [
                'name' => 'Tournoi du FC Reims',
                'date' => '2024-07-03',
                'price' => '15',
                'rewards' => 'medailles',
                'nombre équipes'=> '16',
                'nombre joueurs' => '12',
                'location' => 'Reims',
                'Poster' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.science-et-vie.com%2Fscience-et-culture%2Fqui-etait-ragnar-lothbrok-130245.html&psig=AOvVaw3HwLxJvo0ikemJg-eTljm7&ust=1720085608912000&source=images&cd=vfe&opi=89978449&ved=0CA8QjRxqFwoTCMjwuq_IiocDFQAAAAAdAAAAABAE',
                'created_at' => '2024-07-03',
            ];

            [
                'name' => 'Tournoi du FC Toulouse',
                'date' => '2024-07-03',
                'price' => '15',
                'rewards' => 'medailles',
                'nombre équipes'=> '16',
                'nombre joueurs' => '12',
                'location' => 'Toulouse',
                'Poster' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.science-et-vie.com%2Fscience-et-culture%2Fqui-etait-ragnar-lothbrok-130245.html&psig=AOvVaw3HwLxJvo0ikemJg-eTljm7&ust=1720085608912000&source=images&cd=vfe&opi=89978449&ved=0CA8QjRxqFwoTCMjwuq_IiocDFQAAAAAdAAAAABAE',
                'created_at' => '2024-07-03',
            ];

            [
                'name' => 'Tournoi du FC Nantes',
                'date' => '2024-07-03',
                'price' => '15',
                'rewards' => 'medailles',
                'nombre équipes'=> '16',
                'nombre joueurs' => '12',
                'location' => 'Nantes',
                'Poster' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.science-et-vie.com%2Fscience-et-culture%2Fqui-etait-ragnar-lothbrok-130245.html&psig=AOvVaw3HwLxJvo0ikemJg-eTljm7&ust=1720085608912000&source=images&cd=vfe&opi=89978449&ved=0CA8QjRxqFwoTCMjwuq_IiocDFQAAAAAdAAAAABAE',
                'created_at' => '2024-07-03',
            ];

            [
                'name' => 'Tournoi du FC Lyon',
                'date' => '2024-07-02',
                'price' => '15',
                'rewards' => 'medailles',
                'nombre équipes'=> '16',
                'nombre joueurs' => '12',
                'location' => 'Lyon',
                'Poster' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.science-et-vie.com%2Fscience-et-culture%2Fqui-etait-ragnar-lothbrok-130245.html&psig=AOvVaw3HwLxJvo0ikemJg-eTljm7&ust=1720085608912000&source=images&cd=vfe&opi=89978449&ved=0CA8QjRxqFwoTCMjwuq_IiocDFQAAAAAdAAAAABAE',
                'created_at' => '2024-07-01',
            ];

        $createdTournaments = [];
        foreach($tournaments as $currentTournament)
    {
        $newTournament = new Tournament();
        $newTournament->setTournamentName($currentTournament);


        $createdTournaments[] = $newTournament;
        $manager->persist($newTournament);

        $manager->flush();

        return $createdTournaments;
    }
    }

        /* CLUBS **/
private function loadClubs(ObjectManager $manager)
{
    $clubs = 

    [
        'name' => 'FC Paris',
        'licence_number' => 12345678,
        'adress' => 'allée de Lyon',
        'logo' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.science-et-vie.com%2Fscience-et-culture%2Fqui-etait-ragnar-lothbrok-130245.html&psig=AOvVaw3HwLxJvo0ikemJg-eTljm7&ust=1720085608912000&source=images&cd=vfe&opi=89978449&ved=0CA8QjRxqFwoTCMjwuq_IiocDFQAAAAAdAAAAABAE',
      
    ];
    [
        'name' => 'FC Toulouse',
        'licence_number' => 12345678,
        'adress' => 'allée de Toulouse',
        'logo' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.science-et-vie.com%2Fscience-et-culture%2Fqui-etait-ragnar-lothbrok-130245.html&psig=AOvVaw3HwLxJvo0ikemJg-eTljm7&ust=1720085608912000&source=images&cd=vfe&opi=89978449&ved=0CA8QjRxqFwoTCMjwuq_IiocDFQAAAAAdAAAAABAE',
        
    ];

    [
        'name' => 'FC Rennes',
        'licence_number' => 12345678,
        'adress' => 'allée de Rennes',
        'logo' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.science-et-vie.com%2Fscience-et-culture%2Fqui-etait-ragnar-lothbrok-130245.html&psig=AOvVaw3HwLxJvo0ikemJg-eTljm7&ust=1720085608912000&source=images&cd=vfe&opi=89978449&ved=0CA8QjRxqFwoTCMjwuq_IiocDFQAAAAAdAAAAABAE',
        
    ];

    [
        'name' => 'FC Lyon',
        'licence_number' => 12345678,
        'price' => '15',
        'adress' => 'allée de Lyon',
        'logo' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.science-et-vie.com%2Fscience-et-culture%2Fqui-etait-ragnar-lothbrok-130245.html&psig=AOvVaw3HwLxJvo0ikemJg-eTljm7&ust=1720085608912000&source=images&cd=vfe&opi=89978449&ved=0CA8QjRxqFwoTCMjwuq_IiocDFQAAAAAdAAAAABAE',
      
    ];

    $createdClubs = [];
    foreach($clubs as $currentClub)
    {
        $newClub = new Club();
        $newClub->setClubName($currentClub);


        $createdClubs[] = $newClub;
        $manager->persist($newClub);
    }

    $manager->flush();

    return $createdClubs;
}


}
