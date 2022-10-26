window.Echo.private('App.Models.User.10')
    .notification((notification) => {
        Notification.requestPermission(notification => {

            let notify = new Notification("MarketPlace", {
                body: "Your post was ...."
            });

            notify.onclick = () => {
                window.open(window.location.href)
            };
        });
    });
