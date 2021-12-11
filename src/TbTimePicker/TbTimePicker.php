<?php
/**
 * Twitter Bootstrap DateTimePicker Input Control
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   https://componette.com/radekdostal/nette-datetimepicker/
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2014  - 2018 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      https://www.radekdostal.cz
 */

namespace RadekDostal\NetteComponents\DateTimePicker;

use Nette\Forms\Container;
use Nette\Utils\DateTime;

/**
 * Twitter Bootstrap DateTimePicker Input Control
 *
 * @author Radek Dostál
 */
class TbTimePicker extends AbstractDateTimePicker
{
  /**
   * Default format
   *
   * @var string
   */
  protected $format = 'H:i';
  protected $dateFormat = 'Y-m-d';

  /**
   * Sets date and time
   *
   * @param string $value date and time
   * @return void
   */
  public function setValue($value)
  {
    if ($value instanceof \DateTime)
      $value = $value->format($this->format);
	
    parent::setValue($value);
  }

  /**
   * Returns date and time
   *
   * @return mixed
   */
  public function getValue()
  {
    if (strlen($this->value) > 0)
    {
      $datetime = DateTime::createFromFormat($this->dateFormat . ' '.  $this->format, '0000-01-02' . ' ' . $this->value);

      if ($datetime === FALSE)
      {
        $this->addError($this->getValueErrorMessage());

        return FALSE;
      }

      return $datetime;
    }

    return $this->value;
  }

  /**
   * Registers this control
   *
   * @param string $format format
   * @return self
   */
  public static function register($format = NULL)
  {
    Container::extensionMethod('addTbTimePicker', function($container, $name, $label = NULL, $maxLength = NULL) use ($format)
    {
      $picker = $container[$name] = new TbTimePicker($label, $maxLength);

      if ($format !== NULL)
        $picker->setFormat($format);

      return $picker;
    });

    parent::setValidationMessages();
  }
}
