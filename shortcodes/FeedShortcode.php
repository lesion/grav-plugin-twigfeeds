<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class FeedShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('feed', function(ShortcodeInterface $sc) {
            $items = $this->grav['twig']->twig_vars['twig_feeds'][$sc->getContent()]['items'];
            $output = "";
            foreach($items as $item) {
                $output .= "<h3><a href='".$item['link']."'>".$item['title']."</a></h3>";
                $output .= "<p>".$item['description']."</p>";
            }
            return $output;
        });
    }
}