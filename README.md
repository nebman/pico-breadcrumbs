pico-breadcrumbs
================
Picoのサイトにパンくずリストを表示するプラグインです。
サイトの記事がディレクトリ(フォルダ)構造を持っている場合に、パンくずリストを生成します。

## 使用方法

1. プラグインをダウンロードし、`plugins`フォルダに`pico_breadcrumbs`というフォルダ名で保存する
2. `config/config.yml`に、`Pico_Breadcrumbs.enabled = true`という行を書き加える

## 記事に追加する値

なし

##  追加するTwig変数

 * breadcrumbs:パンくずリストを含む配列
  * url: ページのURL
  * name: ページのタイトル
  * exists: ページが存在する場合はtrue。

### 記述例

```php
  {% if breadcrumbs %}
    <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
      <a href="/" itemprop="url"><span itemprop="title">{{ site_title }}</span></a>
      {% for crumb in breadcrumbs %}
        <div itemprop="child" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
          &nbsp;&gt;&nbsp; 
          <a href="{{ crumb.url }}" itemprop="url"><span itemprop="title">{{ crumb.name }}</span></a>
        </div>
      {% endfor %}
    </div>
  {% endif %}
```

##  コンフィグオプション
なし