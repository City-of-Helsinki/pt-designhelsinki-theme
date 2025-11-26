(() => {
  initMobileToggle(document.getElementById('mobile-menu-panel-toggle'));

  function initMobileToggle(menuToggle) {
    if (! menuToggle) {
      return;
    }

    const menuPanel = document.getElementById(menuToggle.getAttribute('aria-controls'));
    if (! menuPanel) {
      return;
    }

    const isToggleExpanded = () => 'true' === menuToggle.getAttribute('aria-expanded');
    const setToggleExpanded = (expanded) => menuToggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
    const setPanelOpen = (open) => open ? menuPanel.classList.add('open') : menuPanel.classList.remove('open');

    const offClickHandler = (event) => {
      if (menuToggle !== event.target && ! menuPanel.contains(event.target)) {
        mobileMenuOpen(false);
      }
    };

    const mobileMenuOpen = (open) => {
      setPanelOpen(open);
      setToggleExpanded(open);
    };

    menuToggle.addEventListener('click', event => {
      if (isToggleExpanded()) {
        mobileMenuOpen(false);
        document.body.removeEventListener('click', offClickHandler);
      } else {
        mobileMenuOpen(true);
        document.body.addEventListener('click', offClickHandler);
      }
    });
  }

})();
