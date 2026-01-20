<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

class mittel_watermark extends CModule
{
    public $MODULE_ID = "mittel.watermark";
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $MODULE_CSS;
    public $MODULE_GROUP_RIGHTS = "Y";

    public function __construct()
    {
        $arModuleVersion = array();
        include(dirname(__FILE__) . "/version.php");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = GetMessage("IMYIE.MORE_WATERMARK.MODULE_INSTALL_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("IMYIE.MORE_WATERMARK.INSTALL_DESCRIPTION");
        $this->PARTNER_NAME = GetMessage("IMYIE.MORE_WATERMARK.INSTALL_COPMPANY_NAME");
		$this->PARTNER_URI = "https://hi-techmedia.ru/";
    }

    public function InstallDB()
    {
        ModuleManager::registerModule("mittel.watermark");

        return true;
    }

    public function InstallFiles()
    {
        return true;
    }

    public function InstallPublic()
    {
        return true;
    }

    public function InstallEvents()
    {
        RegisterModuleDependences(
            "iblock",
            "OnBeforeIBlockElementAdd",
            "mittel.watermark",
            "CIMYIEMoreWatermark",
            "OnBeforeIBlockElementAdd",
            "100000"
        );

        RegisterModuleDependences(
            "iblock",
            "OnBeforeIBlockElementUpdate",
            "mittel.watermark",
            "CIMYIEMoreWatermark",
            "OnBeforeIBlockElementUpdate",
            "100000"
        );

        return true;
    }

    public function UnInstallDB($arParams = array())
    {
        ModuleManager::unRegisterModule("mittel.watermark");

        return true;
    }

    public function UnInstallFiles()
    {
        return true;
    }

    public function UnInstallPublic()
    {
        return true;
    }

    public function UnInstallEvents()
    {
        COption::RemoveOption("mittel.watermark");

        UnRegisterModuleDependences(
            "iblock",
            "OnBeforeIBlockElementAdd",
            "mittel.watermark",
            "CIMYIEMoreWatermark",
            "OnBeforeIBlockElementAdd"
        );

        UnRegisterModuleDependences(
            "iblock",
            "OnBeforeIBlockElementUpdate",
            "mittel.watermark",
            "CIMYIEMoreWatermark",
            "OnBeforeIBlockElementUpdate"
        );

        return true;
    }

    public function DoInstall()
    {
        global $APPLICATION, $step;

        $this->InstallFiles();
        $this->InstallDB();
        $this->InstallEvents();
        $this->InstallPublic();

        $APPLICATION->IncludeAdminFile(
            GetMessage("SPER_INSTALL_TITLE"),
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/mittel.watermark/install/install.php"
        );
    }

    public function DoUninstall()
    {
        global $APPLICATION, $step;

        $this->UnInstallFiles();
        $this->UnInstallDB();
        $this->UnInstallEvents();
        $this->UnInstallPublic();

        $APPLICATION->IncludeAdminFile(
            GetMessage("SPER_UNINSTALL_TITLE"),
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/mittel.watermark/install/uninstall.php"
        );
    }
}
