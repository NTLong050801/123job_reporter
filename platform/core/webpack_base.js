const mix = require('laravel-mix');
class WebpackBase {
    constructor()
    {
        this.configWebpack =  null;
        this.scssCompile =  null;
        this.jsCompile =  null;
        this.__dirname =  null;
        return this;
    }

    pluginPath(path)
    {
        this.__dirname = path;
        return this;
    }

    setConfig(config)
    {
        this.configWebpack = config;
        return this;
    }

    scss(scss)
    {
        this.scssCompile = scss;
        return this;
    }

    js(js)
    {
        this.jsCompile = js;
        return this;
    }

    runAsset(publicPath)
    {
        let that = this;
        if(this.scssCompile)
        {
            this.scssCompile.map((val) => {
                let from = that.__dirname + val.from,
                    to = val.to;
                mix.sass(from, to).minify(publicPath + to)
            });
        }

        this.jsCompile.map((val) => {
            let from = that.__dirname + val.from,
                to = val.to;
            mix.js(from, to)
        });
    }

    mergeConfig()
    {
        mix.webpackConfig({
            module: {
                rules: []
            },
        });
        mix.options({
            processCssUrls: false,
            terser: {
                extractComments: false,
            }
        }).autoload({
            jquery: ['$', 'window.jQuery', 'jQuery']
        });
        if (mix.inProduction()) {
            mix.version();
        }


        if (this.configWebpack)
        {
            mix.webpackConfig(this.configWebpack)
        }

    }

    public(publicPath)
    {
        mix.setPublicPath(publicPath);
        this.runAsset(publicPath);
        this.mergeConfig();
    }
}

let webpackInstance = new WebpackBase();
module.exports = webpackInstance;
