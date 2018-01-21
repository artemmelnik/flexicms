<?php
namespace Flexi\Sitemap;

/**
 * The AbstractSitemap class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class AbstractSitemap
{
	/**
	 * Property root.
	 *
	 * @var  string
	 */
	protected $root = 'sitemap';

	/**
	 * Property xmlns.
	 *
	 * @var  string
	 */
	protected $xmlns = 'http://www.sitemaps.org/schemas/sitemap/0.9';

	/**
	 * Property encoding.
	 *
	 * @var  string
	 */
	protected $encoding = 'utf-8';

	/**
	 * Property XmlVersion.
	 *
	 * @var  string
	 */
	protected $xmlVersion = '1.0';

	/**
	 * Property xml.
	 *
	 * @var  \SimpleXMLElement
	 */
	protected $xml;

	/**
	 * Property autoEscape.
	 *
	 * @var  boolean
	 */
	protected $autoEscape = true;

	/**
	 * Property dateFormat.
	 *
	 * @var  string
	 */
	protected $dateFormat = '';

	/**
	 * Class init.
	 *
	 * @param string $xmlns
	 * @param string $encoding
	 * @param string $XmlVersion
	 */
	public function __construct($xmlns = null, $encoding = 'utf-8', $XmlVersion = '1.0')
	{
		$this->xmlns      = $xmlns ? : $this->xmlns;
		$this->encoding   = $encoding;
		$this->xmlVersion = $XmlVersion;

		$this->dateFormat = \DateTime::W3C;

		$this->xml = $this->getSimpleXmlElement();
	}

	/**
	 * getSimpleXmlElement
	 *
	 * @return  \SimpleXMLElement
	 */
	public function getSimpleXmlElement()
	{
		if (!$this->xml) {
			$this->xml = simplexml_load_string(
				sprintf(
					'<?xml version="%s" encoding="%s"?' . '><%s xmlns="%s" />',
					$this->xmlVersion,
					$this->encoding,
					$this->root,
					$this->xmlns
				)
			);
		}

		return $this->xml;
	}

	/**
	 * toString
	 *
	 * @return  string
	 */
	public function toString()
	{
		return $this->xml->asXML();
	}

	/**
	 * __toString
	 *
	 * @return  string
	 */
	public function __toString()
	{
		try {
			return $this->toString();
		} catch (\Exception $e) {
			return $e;
		}
	}

	/**
	 * Method to get property AutoEscape
	 *
	 * @return  boolean
	 */
	public function getAutoEscape()
	{
		return $this->autoEscape;
	}

	/**
	 * Method to set property autoEscape
	 *
	 * @param   boolean $autoEscape
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setAutoEscape($autoEscape)
	{
		$this->autoEscape = $autoEscape;

		return $this;
	}

	/**
	 * Method to get property DateFormat
	 *
	 * @return  string
	 */
	public function getDateFormat()
	{
		return $this->dateFormat;
	}

	/**
	 * Method to set property dateFormat
	 *
	 * @param   string $dateFormat
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setDateFormat($dateFormat)
	{
		$this->dateFormat = $dateFormat;

		return $this;
	}
}
