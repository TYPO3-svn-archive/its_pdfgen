var page = require('webpage').create(),
    system = require('system'),
    address, output, size;

if (system.args.length < 3 || system.args.length > 6) {
    console.log('Usage: rasterize.js URL filename cookiename cookievalue');
    phantom.exit(1);
} else {
    address = system.args[1];
    output = system.args[2];
    cookiename = system.args[3];
    cookievalue = system.args[4];
    cookiedomain = system.args[5];
    page.viewportSize = { width: 600, height: 600 };
    if (system.args.length > 3 && system.args[2].substr(-4) === ".pdf") {
        size = system.args[3].split('*');
        page.paperSize =  { format: 'A4', orientation: 'portrait', border: '1cm' };
    }
phantom.addCookie({
    'name':     cookiename,   /* required property */
    'value':    cookievalue,
    'domain':   cookiedomain,           /* required property */
    'path':     '/',
    'httponly': true,
    'secure':   false,
    'expires':  (new Date()).getTime() + (1000 * 60 * 60)   /* <-- expires in 1 hour */
});
    page.settings.userAgent = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:25.0) Gecko/20100101 Firefox/26.0';
    console.log('address: ' +address);
    console.log('output: ' +output);
    console.log('cookiedomain: ' +cookiedomain);
    console.log('cookiename: ' +cookiename);
    page.open(address, function (status) {
        if (status !== 'success') {
            console.log('Unable to load the address!');
            phantom.exit();
        } else {
            window.setTimeout(function () {
                page.render(output);
                phantom.exit();
            }, 200);
        }
    });
}
