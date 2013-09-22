<?php

namespace GtaCool\Bundle\InuitCssBundle\Command;

use Sensio\Bundle\GeneratorBundle\Command\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Sensio\Bundle\GeneratorBundle\Command\Validators;
use GtaCool\Bundle\InuitCssBundle\Generator\InuitCssGenerator;

/**
 * Generates inuit.css files into a bundle.
 *
 * @author Jonathan Plugaru <jplugaru@hotmail.fr>
 */
class GenerateInuitCssCommand extends GeneratorCommand
{
    /**
     * @see Command
     */
    public function configure()
    {
        $this
            ->setDefinition(array(
                new InputOption(
                    'bundle',
                    '',
                    InputOption::VALUE_REQUIRED,
                    'The name of the bundle where inuit.css files will be generated'
                ),
            ))
            ->setDescription('Generates inuit.css files inside a bundle')
            ->setHelp(<<<EOT
The <info>inuit.css:generate:existent-bundle</info> command helps you generates inuit.css files
inside bundles.

By default, the command interacts with the developer to tweak the generation.
Any passed option will be used as a default value for the interaction
(<comment>--bundle</comment> is the only one needed if you follow the conventions):

<info>php app/console inuit.css:generate:existent-bundle --bundle=AcmeBlogBundle</info>

If you want to disable any user interaction, use <comment>--no-interaction</comment>
but don't forget to pass all needed options:

<info>php app/console inuit.css:generate:existent-bundle --bundle=AcmeBlogBundle --no-interaction</info>
EOT
            )
            ->setName('inuit.css:generate:existent-bundle')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $dialog = $this->getDialogHelper();

        if ($input->isInteractive()) {
            if (!$dialog->askConfirmation($output, $dialog->getQuestion('Do you confirm generation', 'yes', '?'), true)) {
                $output->writeln('<error>Command aborted</error>');

                return 1;
            }
        }

        if (null === $input->getOption('bundle')) {
            throw new \RuntimeException('The bundle option must be provided.');
        }

        $bundle = $input->getOption('bundle');
        if (is_string($bundle)) {
            $bundle = Validators::validateBundleName($bundle);

            try {
                $bundle = $this->getContainer()->get('kernel')->getBundle($bundle);
            } catch (\Exception $e) {
                $output->writeln(sprintf('<bg=red>Bundle "%s" does not exist.</>', $bundle));
            }
        }

        $generator = $this->getGenerator($bundle);
        $generator->generate($bundle);

        $output->writeln('Generating the inuit.css code: <info>OK</info>');

        $dialog->writeGeneratorSummary($output, array());
    }

    public function interact(InputInterface $input, OutputInterface $output)
    {
        $dialog = $this->getDialogHelper();
        $dialog->writeSection($output, 'Welcome to the Symfony2 inuit.css generator');

        // namespace
        $output->writeln(array(
            '',
            'First, you need to give the bundle name where inuit.css file will be generated.',
            'You must use the shortcut notation like <comment>AcmeBlogBundle</comment>',
            '',
        ));

        while (true) {
            $bundle = $dialog->askAndValidate($output, $dialog->getQuestion('Bundle name', $input->getOption('bundle')), array('Sensio\Bundle\GeneratorBundle\Command\Validators', 'validateBundleName'), false, $input->getOption('bundle'));

            try {
                $b = $this->getContainer()->get('kernel')->getBundle($bundle);

                if (!file_exists($b->getPath().'/Resources/public/css/style.scss')) {
                    break;
                }

                $output->writeln(sprintf('<bg=red>Inuit.css files already exists inside "%s".</>', $bundle));
            } catch (\Exception $e) {
                $output->writeln(sprintf('<bg=red>Bundle "%s" does not exist.</>', $bundle));
            }
        }
        $input->setOption('bundle', $bundle);

        // summary
        $output->writeln(array(
            '',
            $this->getHelper('formatter')->formatBlock('Summary before generation', 'bg=blue;fg-white', true),
            '',
            sprintf('You are going to generate inuit.css files inside "<info>%s</info>" bundle', $bundle),
            '',
        ));
    }

    protected function createGenerator()
    {
        return new InuitCssGenerator($this->getContainer()->get('filesystem'), __DIR__.'/../Resources/skeleton');
    }
}
