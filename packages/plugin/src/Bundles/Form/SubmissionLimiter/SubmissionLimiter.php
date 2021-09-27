<?php

namespace Solspace\Freeform\Bundles\Form\SubmissionLimiter;

use Solspace\Freeform\Events\Forms\SubmitEvent;
use Solspace\Freeform\Freeform;
use Solspace\Freeform\Library\Bundles\BundleInterface;
use Solspace\Freeform\Library\Composer\Components\Form;
use yii\base\Event;

class SubmissionLimiter implements BundleInterface
{
    const BAG_KEY = 'submissionLimit';

    public function __construct()
    {
        Event::on(Form::class, Form::EVENT_SUBMIT, [$this, 'handleLimit']);
    }

    public function handleLimit(SubmitEvent $event)
    {
        $form = $event->getForm();
        $limit = $form->getPropertyBag()->get(self::BAG_KEY);

        if (null === $limit) {
            return;
        }

        if ($limit > $this->getSubmissionCount($form)) {
            return;
        }

        $form->addError(Freeform::t('Submission limit reached'));
        $event->isValid = false;
    }

    private function getSubmissionCount(Form $form): int
    {
        return Freeform::getInstance()->submissions->getSubmissionCount([$form->getId()]);
    }
}