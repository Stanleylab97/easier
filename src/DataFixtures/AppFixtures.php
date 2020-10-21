<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Bordereau;
use Faker;
use App\Entity\Agence;
use App\Entity\Categorie;
use App\Entity\Abonne;
use App\Entity\Compteur;
use App\Entity\Facture;
use App\Entity\Periode;
use App\Entity\Quittance;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $agence1 = new Agence();
        $agence1->setLibelle("Agence Ganhi");
        $agence1->setLon(4.82098);
        $agence1->setLat(2.91748);
        $manager->persist($agence1);
        $manager->flush();

        $agence2 = new Agence();
        $agence2->setLibelle("Agence Cité Houéyiho");
        $agence2->setLon(2.7187);
        $agence2->setLat(6.2548);
        $manager->persist($agence2);
        $manager->flush();

        $categorie1=new Categorie();
        $categorie1->setCode("01");
        $categorie1->setLibelle("Particulier");
        $manager->persist($categorie1);

        $categorie2=new Categorie();
        $categorie2->setCode("02");
        $categorie2->setLibelle("Entreprise");
        $manager->persist($categorie2);

        $categorie3=new Categorie();
        $categorie3->setCode("03");
        $categorie3->setLibelle("Administration");
        $manager->persist($categorie3);

        $manager->flush();

        $period1=new Periode();
        $period1->setDateDebut($faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null));
        $period1->setDateFin($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null));
        $period1->setDateEcheance($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null));
        $period1->setPeriodFact($faker->monthName("December")." ".$faker->year($max = 'now'));
        $manager->persist($period1);
        $manager->flush();
        
        $period2=new Periode();
        $period2->setDateDebut($faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null));
        $period2->setDateFin($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null));
        $period2->setDateEcheance($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null));
        $period2->setPeriodFact($faker->monthName("December")." ".$faker->year($max = 'now'));
        $manager->persist($period2);
        $manager->flush();

        $period3=new Periode();
        $period3->setDateDebut($faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null));
        $period3->setDateFin($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null));
        $period3->setDateEcheance($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null));
        $period3->setPeriodFact($faker->monthName("December")." ".$faker->year($max = 'now'));
        $manager->persist($period3);
        $manager->flush();

        $period4=new Periode();
        $period4->setDateDebut($faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null));
        $period4->setDateFin($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null));
        $period4->setDateEcheance($faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null));
        $period4->setPeriodFact($faker->monthName("December")." ".$faker->year($max = 'now'));
        $manager->persist($period4);
        $manager->flush();

        $abonne1=new Abonne();
        $abonne1->setNom($faker->name);
        $abonne1->setAdresse($faker->streetName);
        $abonne1->setNumAbonne("AB".$faker->randomNumber(5, $strict = false));
        $abonne1->setTel(''.$faker->e164PhoneNumber);
        $abonne1->setCategorie($categorie1);
        $manager->persist($abonne1);
        $manager->flush();

        $abonne2=new Abonne();
        $abonne2->setNom($faker->name);
        $abonne2->setAdresse($faker->streetName);
        $abonne2->setNumAbonne("AB".$faker->randomNumber(5, $strict = false));
        $abonne2->setTel(''.$faker->e164PhoneNumber);
        $abonne2->setCategorie($categorie2);
        $manager->persist($abonne2);
        $manager->flush();

        $abonne3=new Abonne();
        $abonne3->setNom($faker->name);
        $abonne3->setAdresse($faker->streetName);
        $abonne3->setTel(''.$faker->e164PhoneNumber);
        $abonne3->setCategorie($categorie2);
        $abonne3->setNumAbonne("AB".$faker->randomNumber(5, $strict = false));
        $manager->persist($abonne3);
        $manager->flush();

        $abonne4=new Abonne();
        $abonne4->setNom($faker->name);
        $abonne4->setAdresse($faker->streetName);
        $abonne4->setTel(''.$faker->e164PhoneNumber);
        $abonne4->setCategorie($categorie3);
        $abonne4->setNumAbonne("AB".$faker->randomNumber(5, $strict = false));
        $manager->persist($abonne4);
        $manager->flush();

        for ($i = 0; $i < 6; $i++) {
            $bordereau = new Bordereau();
            $bordereau->setLibelle(''.$i);
            $bordereau->setQuartier($faker->city);
            $i%2?$bordereau->setAgence($agence1):$bordereau->setAgence($agence2);
            $manager->persist($bordereau);
            $manager->flush();
            
            for($i=0;$i<2;$i++){
                $compteur=new Compteur();
                $compteur->setNumPolice('');
                $compteur->setPuissance(10);
                $compteur->setTarif(120);
                $compteur->setCarre($faker->address);
                $compteur->setBordereau($bordereau);
                $compteur->setAbonne($abonne1);
                $manager->persist($compteur);
                $manager->flush();

                for($i=0;$i<15;$i++){
                    $facture=new Facture();
                    $facture->setNumFact("F".$faker->randomNumber(5, $strict = false));
                    $min=$faker->randomNumber(5);
                    $max=$faker->randomNumber(5);
                    if($min<$max){
                        $facture->setLastIndex($min);
                        $facture->setNewIndex($max);
                    }else{
                        $x=$max;
                        $min=$x;
                        $max=$min;
                        $facture->setLastIndex($min);
                        $facture->setNewIndex($max);
                    }
                    $facture->setNbkwh($max-$min);
                    $facture->setMontantFact($faker->randomNumber(5));
                    $facture->setPeriode($period1); 
                    $facture->setCompteur($compteur);
                    $manager->persist($facture);
                    $manager->flush();
                    if($i>=14){
                        $quittance=new Quittance();
                        $quittance->setDateReglement($period1->getDateEcheance());
                        $quittance->setMoyen("Caisse");
                        $quittance->setNumQuittance("Q".$faker->randomNumber(8, $strict = false));
                        $quittance->setFactureId($facture);
                        $quittance->setTransactionId("NULL");
                        $manager->persist($quittance);
                        $manager->flush();
                    }
                }
            }
            
                $compteur=new Compteur();
                $compteur->setNumPolice('GD'.$faker->randomNumber(5, $strict = false));
                $compteur->setPuissance(10);
                $compteur->setTarif(120);
                $compteur->setCarre($faker->address);
                $compteur->setBordereau($bordereau);
                $compteur->setAbonne($abonne2); 
                $manager->persist($compteur);
                $manager->flush();
                for($i=0;$i<15;$i++){
                    $facture=new Facture();
                    $facture->setNumFact("F".$faker->randomNumber(5, $strict = false));
                    $min=$faker->randomNumber(5);
                    $max=$faker->randomNumber(5);
                    if($min<$max){
                        $facture->setLastIndex($min);
                        $facture->setNewIndex($max);
                    }else{
                        $x=$max;
                        $min=$x;
                        $max=$min;
                        $facture->setLastIndex($min);
                        $facture->setNewIndex($max);
                    }
                    $facture->setNbkwh($max-$min);
                    $facture->setMontantFact($faker->randomNumber(5));
                    $facture->setPeriode($period2); 
                    $facture->setCompteur($compteur);
                    $manager->persist($facture);
                    $manager->flush();
                    if($i>=14){
                        $quittance=new Quittance();
                        $quittance->setDateReglement($period1->getDateEcheance());
                        $quittance->setMoyen("Caisse");
                        $quittance->setNumQuittance("Q".$faker->randomNumber(8, $strict = false));
                        $quittance->setFactureId($facture);
                        $quittance->setTransactionId("NULL");
                        $manager->persist($quittance);
                        $manager->flush();
                    }
                }
                
           
            for($i=0;$i<2;$i++){
                $compteur=new Compteur();
                $compteur->setNumPolice(''.$faker->randomNumber(5, $strict = false));
                $compteur->setPuissance(15);
                $compteur->setTarif(170);
                $compteur->setCarre($faker->address);
                $compteur->setBordereau($bordereau);
                $compteur->setAbonne($abonne3); 
                $manager->persist($compteur);
                $manager->flush();

                for($i=0;$i<15;$i++){
                    $facture=new Facture();
                    $facture->setNumFact("F".$faker->randomNumber(5, $strict = false));
                    $min=$faker->randomNumber(5);
                    $max=$faker->randomNumber(5);
                    if($min<$max){
                        $facture->setLastIndex($min);
                        $facture->setNewIndex($max);
                    }else{
                        $x=$max;
                        $min=$x;
                        $max=$min;
                        $facture->setLastIndex($min);
                        $facture->setNewIndex($max);
                    }
                    $facture->setNbkwh($max-$min);
                    $facture->setMontantFact($faker->randomNumber(5));
                    $facture->setPeriode($period3); 
                    $facture->setCompteur($compteur);
                    $manager->persist($facture);
                    $manager->flush();
                    if($i>=14){
                        $quittance=new Quittance();
                        $quittance->setDateReglement($period1->getDateEcheance());
                        $quittance->setMoyen("MoMo");
                        $quittance->setNumQuittance("Q".$faker->randomNumber(8, $strict = false));
                        $quittance->setFactureId($facture);
                        $quittance->setTransactionId($faker->uuid);
                        $manager->persist($quittance);
                        $manager->flush();
                    }
                    
                    
                }
            }
            for($i=0;$i<10;$i++){
                $compteur=new Compteur();
                $compteur->setNumPolice(''.$faker->randomNumber(5, $strict = false));
                $compteur->setPuissance(5);
                $compteur->setTarif(115);
                $compteur->setCarre($faker->address);
                $compteur->setBordereau($bordereau);
                $compteur->setAbonne($abonne4); 
                $manager->persist($compteur);
                $manager->flush();
                for($i=0;$i<15;$i++){
                    $facture=new Facture();
                    $facture->setNumFact("F".$faker->randomNumber(9));
                    $min=$faker->randomNumber(5);
                    $max=$faker->randomNumber(5);
                    if($min<$max){
                        $facture->setLastIndex($min);
                        $facture->setNewIndex($max);
                    }else{
                        $x=$max;
                        $min=$x;
                        $max=$min;
                        $facture->setLastIndex($min);
                        $facture->setNewIndex($max);
                    }
                    $facture->setNbkwh($max-$min);
                    $facture->setMontantFact($faker->randomNumber(5));
                    $facture->setPeriode($period4); 
                    $facture->setCompteur($compteur);
                    $manager->persist($facture);
                    $manager->flush();
                    
                    $quittance=new Quittance();
                    $quittance->setDateReglement($period1->getDateEcheance());
                    $quittance->setMoyen("MoMo");
                    $quittance->setNumQuittance("Q".$faker->randomNumber(8, $strict = false));
                    $quittance->setFactureId($facture);
                    $quittance->setTransactionId($faker->uuid);
                    $manager->persist($quittance);
                    $manager->flush();
                }
            }

       
        }

        $manager->flush();

       


    }
}
