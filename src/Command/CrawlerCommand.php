<?php
// src/Command/CrawlerCommand.php
namespace App\Command;

// Entity
use App\Entity\LinkDetails;

// Dependencies
use App\Service\Crawler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CrawlerCommand extends Command
{
    private $crawler;
    private $em;

    public function __construct(EntityManagerInterface $em, Crawler $crawler)
    {
        $this->crawler = $crawler;
        $this->em      = $em;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('app:crawler')
            ->setDescription('Crawls new and old links');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $repository = $this->em->getRepository(LinkDetails::class);

        $linkDetails = $repository->findByUpdatable();

        foreach ($linkDetails as $ld)
        {
            $this->crawler->addLink($ld->getLink());
        }

        $this->crawler->crawl();
    }
}
