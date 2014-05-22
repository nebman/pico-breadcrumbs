pico-breadcrumbs
================

Adds breadcrumbs for navigation and search engine detection

## Usage

Add the following code to your template file index.html, it is optimized for Google indexing

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
