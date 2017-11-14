<?php
namespace BOF\Command;

use Doctrine\DBAL\Driver\Connection;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;

class ReportYearlyCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('report:profiles:yearly')
            ->setDescription('Page views report')
            ->addArgument('year', InputArgument::OPTIONAL, 'Year you are interested in.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var $db Connection */
        $io = new SymfonyStyle($input,$output);
        $db = $this->getContainer()->get('database_connection');

        $year = $input->getArgument('year');

        $profiles = $db->query('SELECT profile_id, profile_name FROM profiles')->fetchAll();
        $profs = array();
        foreach ($profiles as $p) {
            //print_r($p);
            $profs[$p['profile_id']] = $p['profile_name'];
        }

        // I need a nice a query
        // print_r($profs);

        function daysInMonth($month, $year){
            $days=array();
            for($d=1; $d<=31; $d++)
            {
                $time=mktime(12, 0, 0, $month, $d, $year);
                if (date('m', $time)==$month)
                    $list[]=date('Y-m-d', $time);
            }
            //print_r($list);
            return $list;
        }

       function profilePerMonth($db, $pid, $month, $year) {
            $views = array();
            $days = daysInMonth($month, $year);
            $sql = "SELECT SUM(views) FROM views WHERE date > ? AND date < ? AND profile_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(1, $days[0]);
            $stmt->bindValue(2, end($days));
            $stmt->bindValue(3, $pid);
            $stmt->execute();
            $results = $stmt->fetchAll();
            //print_r($results[0]['SUM(views)']);
            $ppm = $results[0]['SUM(views)'];
            if (is_numeric($ppm)) {
                return number_format($ppm);
            }
            return "n/a";
        }

        asort($profs);
        //print_r($aprofs);

        $pidByYear = array();
        $pnameByYear = array();
        foreach ($profs as $pid => $pname) {
            $profileByMonth = array();
            for($m = 1; $m < 13; $m++) {
                $profileByMonth[$m] = profilePerMonth($db, $pid, $m, $year);
            }
            $pidByYear[$pid] = $profileByMonth;
            $pnameByYear[$pid] = array_merge([$pname], $profileByMonth);
        }



        // Show data in a table - headers, data

        //$io->table(["Profile\t".$year], $profiles);

        //profilePerMonth($db, 1, 10, $year);
        //print_r($pidByYear);
        $tableName = "Profile    ".$year;
        $tableHead = [$tableName, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $io->table($tableHead, $pnameByYear);
        echo $input . "\n"; // to je command

    }
}
