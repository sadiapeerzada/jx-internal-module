<?php

namespace Joomla\Plugin\Content\AutoTitleAjax\Extension;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Response\JsonResponse;
use Joomla\CMS\Uri\Uri;

class AutoTitleAjax extends CMSPlugin
{
    protected $autoloadLanguage = true;

    /**
     * Load JavaScript when the article form is opened (administrator)
     */
    public function onContentPrepareForm($form, $data)
    {
        $app = Factory::getApplication();

        // Only in administrator area
        if (!$app->isClient('administrator')) {
            return;
        }

        // Only for article form
        if ($form->getName() !== 'com_content.article') {
            return;
        }

        // Only when creating a new article
        if (!empty($data->id)) {
            return;
        }

        $document = $app->getDocument();
        $wa = $document->getWebAssetManager();

        $ajaxUrl = Uri::base() . 'index.php?option=com_ajax&plugin=autotitleajax&format=json';

        $script = <<<JS
document.addEventListener('DOMContentLoaded', function () {

    const titleField = document.getElementById('jform_title');

    if (!titleField || titleField.value !== '') {
        return;
    }

    fetch('$ajaxUrl', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(result => {
        if (result && result.success && result.data) {
            titleField.value = result.data;
        }
    })
    .catch(error => {
        console.warn('AutoTitleAjax error:', error);
    });

});
JS;

        $wa->addInlineScript($script);
    }

    /**
     * AJAX handler via com_ajax
     */
    public function onAjaxAutotitleajax()
    {
        $text = $this->params->get('default_text', 'Default Title');

        return new JsonResponse($text);
    }
}
