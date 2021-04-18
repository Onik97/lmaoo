export default class Fragment
{
    static createFragment(urlFragment)
    {
        window.location.hash = `#${urlFragment}`;
    }

    static readFragment()
    {
        if (window.location.hash == '') { return('No Url Fragment loaded')}
        return(window.location.hash);
    }

    static updateFragment(urlFragment)
    {
        window.location.hash = `#${urlFragment}`;
    }

    static deleteFragment()
    {
        window.location.hash = '';
        history.pushState("", document.title, window.location.pathname + window.location.search);       
    }
}