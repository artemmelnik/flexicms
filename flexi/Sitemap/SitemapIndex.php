<?php
namespace Flexi\Sitemap;

/**
 * The SitemapIndex class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SitemapIndex extends AbstractSitemap
{
	/**
	 * Property root.
	 *
	 * @var  string
	 */
	protected $root = 'sitemapindex';

	/**
	 * addItem
	 *
	 * @param string           $loc
	 * @param string|\DateTime $lastmod
	 *
	 * @return  static
	 */
	public function addItem($loc, $lastmod = null)
	{
		if ($this->autoEscape) {
			$loc = htmlspecialchars($loc);
		}

		$sitemap = $this->xml->addChild('sitemap');

		$sitemap->addChild('loc', $loc);

		if ($lastmod) {
			if (!($lastmod instanceof \DateTime)) {
				$lastmod = new \DateTime($lastmod);
			}

			$sitemap->addChild('lastmod', $lastmod->format($this->dateFormat));
		}

		return $this;
	}
}
