<?php


namespace Workable\PackageGenerator\Support\View;


use Workable\PackageGenerator\Support\PackageSupport;

class AbstractSyntaxBuilder
{
    /**
     *  Root dir of stubs.
     */
    const STUB_DIR = __DIR__.'/../../../';

    /**
     * A template to be inserted.
     *
     * @var string
     */
    protected $template;

    /**
     * String types supported by bluePrint.
     *
     * @var array
     */
    protected $stringTypes;

    /**
     * Integer types supported by bluePrint.
     *
     * @var array
     */
    protected $integerTypes;

    /**
     * Float types supported by bluePrint.
     *
     * @var array
     */
    protected $floatTypes;

    /**
     * Date types supported by bluePrint.
     *
     * @var array
     */
    protected $dateTypes;

    /**
     * All types supported by bluePrint.
     *
     * @var array
     */
    protected $bluePrintTypes;

    /**
     * AbstractSintaxBuilder constructor.
     */
    public function __construct()
    {
        $packageSupport = PackageSupport::instance();
        $this->stringTypes = $packageSupport->get('stringTypes');
        $this->integerTypes = $packageSupport->get('integerTypes');
        $this->floatTypes = $packageSupport->get('floatTypes');
        $this->dateTypes = $packageSupport->get('dateTypes');
        $this->bluePrintTypes = $packageSupport->get('bluePrintTypes');
    }

    /**
     * Determine if field has foreign constraint.
     *
     * @param array $field
     *
     * @return bool
     */
    protected function hasForeignConstraint(array $field): bool
    {
        return 'foreign' === $field['type'];
    }

    /**
     * Remove empty fields.
     *
     * @param array $fields
     *
     * @return array
     */
    protected function removeEmpty(array $fields): array
    {
        foreach ($fields as $key => $field) {
            if ($field == '') {
                unset($fields[$key]);
            }
        }

        return $fields;
    }

    /**
     * @return mixed
     */
    protected function resolveStubPath($stub)
    {
        $customPath = platform_path('packages/package-generator/'.trim($stub, '/'));
        return file_exists($customPath)
            ? $customPath
            : self::STUB_DIR.trim($stub,'/');
    }
}
