# Insert-Tag zum Einbinden von SVG-Dateien

Stellt Insert-Tags zum Einbinden einer SVG-Datei oder zum benutzen eines Icon aus einem SVG-Sprite zur verfügung. Zum erstellen der Sprites kann die IcoMonn App genutzt werden <https://icomoon.io>.

* **{{svgicon::id}}** für die verwendung einer Icon-Font.
* **{{svguse::id}}** für die verwendung eines SVG-Sprite.
* **{{svgimport::path/to/svg/icon}}** Zum Imporieren eienr SVG (relativ zum Files Verzeichnis).

## Beispile: ##

Der **{{svgicon::icon-phone}}** Insert-Tag wird zu:

`<span class="icon-phone"></span>`

Der **{{svguse::icon-mail}}** Insert-Tag wird zu:

`<svg class="icon icon-mail"><use xlink:href="#icon-mail"></use></svg>`

Der **{{svgimport::theme/svg/facebook}}** Insert-Tag wird zu:

`<svg class="icon icon-facebook" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">...</svg>`
