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
                $images = array_filter($item['medias'] ?? [], function($media) { return str_contains($media['type'], 'image'); } );
                $output .= "<h3><a href='".$item['link']."'> ".$item['title']."</a></h3>";
                if (count($images) > 0) {
                    $image = array_pop($images);
                    $output .= "<img src='{$image['url']}' alt='{$image['title']}'>";
                }
                $output .= "<p>".$item['content']."</p>";
            }
            return $output;
        });
    }
}