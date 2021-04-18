export default class FragmentUrl
{
    static createFragment(currentLocationHash)
    {
        window.location.hash = currentLocationHash;
    }

    {
    }

    static updateFragment(currentLocationHash)
    {
        window.location.hash = currentLocationHash
    }

    static deleteFragment()
    {
        window.location.hash = ''
    }
}