# Magento_Hreflang
This Magento module adds language meta tags in head for each store view locales (with full locale codes, like "en_CA" for Canadian English).

## Example
Will produce this kind of tags:
```html
<link rel="alternate" hreflang="en_US" href="http://en.website.com/my-product.html" />
<link rel="alternate" hreflang="fr_FR" href="http://fr.website.com/mon-produit.html" />
```

## HowTo
You can enable/disable the meta tag from back-office interface (System > Configuration > Canal-web) and decide whether you want to keep categories in products urls or not.

## ToDo
We still need a solution to handle **CMS pages** when their url keys are localised, as for Magento there is no logical link between one page and its versions in other languages.
Use [CmsRewrites](https://github.com/tzyganu/CmsRewrites) ?
