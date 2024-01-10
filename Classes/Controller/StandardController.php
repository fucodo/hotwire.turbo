<?php

namespace fucodo\hotwire\turbo\Controller;


use fucodo\hotwire\turbo\View\TurboView;
use fucodo\registry\Domain\Repository\RegistryEntryRepository;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;

class StandardController extends ActionController
{
    /**
     * A list of formats and object names of the views which should render them.
     *
     * Example:
     *
     * array('html' => 'MyCompany\MyApp\MyHtmlView', 'json' => 'MyCompany\...
     *
     * @var array
     */
    protected $viewFormatToObjectNameMap = [
        'turbo' => TurboView::class
    ];

    /**
     * @FLow\Inject
     * @var RegistryEntryRepository
     */
    protected $registryRepository;

    public function indexAction()
    {
        $this->registryRepository->set('hotwire', 'counter', 1);
    }

    public function secondAction()
    {
        $this->registryRepository->set('hotwire', 'counter', $this->registryRepository->getValue('hotwire', 'counter') +1);
        $this->view->assign('counter', $this->registryRepository->getValue('hotwire', 'counter'));
        sleep(3);
    }

    public function thirdAction()
    {
        $this->view->assign('counter', $this->registryRepository->getValue('hotwire', 'counter'));
        sleep(3);
    }

    public function fourthAction()
    {
        $this->view->assign('counter', $this->registryRepository->getValue('hotwire', 'counter'));
        sleep(2);
    }
}
