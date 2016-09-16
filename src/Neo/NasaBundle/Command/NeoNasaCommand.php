<?php


namespace Neo\NasaBundle\Command;


use Doctrine\ODM\MongoDB\MongoDBException;
use Neo\NasaBundle\Exception\NasaException;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class NeoNasaCommand
 * @package Neo\NasaBundle\Command
 */
class NeoNasaCommand extends ContainerAwareCommand
{
    /**
     * 
     */
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:nasa-data')

            // the short description shown while running "php bin/console list"
            ->setDescription('Command line to request the data from the last 3 days from nasa api')
            ->addArgument('daysNo', InputArgument::OPTIONAL, 'request the data from the last "daysNo" days from nasa api')
            ->addOption('debug', null, InputOption::VALUE_NONE,'If set, the task will run in debug mode' );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $daysNo = $input->getArgument('daysNo');
        try {
            $nasaService = $this->getContainer()->get('nasa.api.service');
            if ($daysNo) {
                $nasaService->setDaysNo($daysNo);
            }
            $data = $nasaService->getNasaData();


            $contentService = $this->getContainer()->get('nasa.content.service');
            $collection = $contentService->getNeoDocumentCollection($data);

            $dm = $this->getContainer()->get('doctrine_mongodb.odm.document_manager');
            foreach ($collection as $document) {
                $dm->persist($document);
            }
            $dm->flush();
            $dm->clear();

            $output->writeln("\n" . $contentService->getNeoCnt() . " objects has been found between " . $nasaService->getStartDate() . " and " . $nasaService->getEndDate());
            $output->writeln("\n" . $contentService->getNeoCnt() . " objects has been inserted in MongoDB");
        } catch (NasaException $e) {
            $output->writeln("\n" . $e->getMessage());
        } catch (MongoDBException $e) {
            $output->writeln("\n" . $e->getMessage());
        }
    }
}