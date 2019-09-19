<?php

use Citfact\SiteCore\City\CityManager;
use \Citfact\SiteCore\Tools\Component\BaseComponent;
use \Citfact\SiteCore\Tools\Container\Container;
use \Bitrix\Main\Context;

class HhruWidgetClass extends BaseComponent
{
    /** @var CityManager */
    private $cityManager;
    private $cityId;
    protected $request;

    public function __construct(CBitrixComponent $component = null)
    {
        $container = Container::getInstance();
        $this->cityManager = $container->get('city_manager');
        $this->request = Context::getCurrent()->getRequest();
        parent::__construct($component);
    }

    public function executeComponent()
    {
        global $APPLICATION;

        $this->getEmployerId();
        $this->getCityId();
        $this->getCityHhAreas();
        $this->getPhoneNumberHR();
        if ($this->request->isAjaxRequest()) {
            $APPLICATION->RestartBuffer();
        }
        $this->includeComponentTemplate();
        if ($this->request->isAjaxRequest()) {
            die();
        }
    }

    /* Получаем текущий ID предприятия */
    private function getEmployerId()
    {
        $this->arResult['EMPLOYER_ID'] = $this->cityManager->getEmployerId();
    }

    /* Получаем ID города */
    private function getCityId()
    {
        if ($this->request->getPost('CITY_ID')) {
            $this->cityId = $this->request->getPost('CITY_ID');
        } else {
            $this->cityId = $this->arParams['CITY_ID'];
        }
        $this->arResult['CITY_ID'] = $this->cityId;
    }

    /* Получаем ID hh.ru города */
    private function getCityHhAreas()
    {
        $this->arResult['HH_AREAS'] = $this->cityManager->getCurrentHhId($this->cityId);
    }

    /* Получаем телефоны отдела кадров текущего города */
    private function getPhoneNumberHR()
    {
        $this->arResult['PHONE_NUMBER'] = $this->cityManager->getPhoneNumberHR($this->cityId);
    }
}