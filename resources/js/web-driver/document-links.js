(() => {
    return Array.from(document.querySelectorAll("ul.ng-star-inserted li.ng-star-inserted div.rs-card__card")).map((el, index) => {
        const button = el.querySelector("div.rs-card__content button.rs-card__options");
        button.click();
        const link = document.querySelector(`a#rs_Download_btn${index}`);
        button.click();
        return link.href;
    });
})()