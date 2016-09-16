<?php


namespace Neo\NasaBundle\Command;


use Doctrine\ODM\MongoDB\MongoDBException;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

/**
 * Class NeoNasaCommand
 * @package Neo\NasaBundle\Command
 */
class TestCommand extends ContainerAwareCommand
{
    /**
     * 
     */
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('test:command')

            // the short description shown while running "php bin/console list"
            ->setDescription('to request the data from the last 3 days from nasa api')
            ->addArgument('id', InputArgument::REQUIRED, 'document id')
            ->addOption('debug', null, InputOption::VALUE_NONE,'If set, the task will run in debug mode' );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getArgument('id');

        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion('This is a test. Do you want to continue (y/N)', false);

        if (!$helper->ask($input, $output, $question)) {
            $output->writeln("\nNothing done. Exiting...");
            return;
        }
        try {

            $dm = $this->getContainer()->get('doctrine_mongodb.odm.document_manager');
            $repository = $dm->getRepository('NasaBundle:Neo');
            $object =  $repository->find($id);
            if($object) {
                $output->writeln("\ndocument exists");
            } else {
                $output->writeln("\ndocument doesn't exist");
            }
        } catch (MongoDBException $e) {
            $output->writeln("\n" . $e->getMessage());
        }
    }
}