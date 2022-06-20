let plyr = function (selector) {
    let players = [];

    // Setup a player entry for each instance
    for (let player of document.querySelectorAll(selector)) {

        player.setAttribute("controls", "");
        player.setAttribute("crossorigin", "");
        player.setAttribute("playsinline", "");
        player.setAttribute("poster", player.dataset.poster);

        // Create new Plyr instance
        let instance = new Plyr(player, {
            title: `${player.getAttribute('data-title')}`,
            invertTime: false,
            listeners: {
                seek: null,
                fastForward: null
            },
            i18n: {
                rewind: 'Voltar 10s',
                fastForward: 'Forward 0s',
                play: 'Play',
                pause: 'Pause',
                liveBroadcast: 'Transmissão ao vivo',
                volume: 'Volume',
                mute: 'Mutar',
                unmute: 'Desmutar',
                captions: 'Legendas',
                subtitles: 'Legendas',
                chapters: 'Capítulos',
                seek: 'Procurar',
                settings: 'Configurações',
                playbackRates: 'Velocidades de reprodução',
                playbackRate: 'Velocidade de reprodução',
                default: 'Padrão',
                donate: 'Doar',
                menuBack: 'Voltar',
                quality: 'Qualidade',
                qualityBadge: {
                    2160: '4K',
                    1080: '1080p',
                    720: '720p',
                    480: '480p',
                    360: '360p',
                    240: '240p',
                    'default': 'Padrão'
                },
                speed: 'Velocidade',
                fullscreen: 'Tela cheia',
                exitFullscreen: 'Sair da tela cheia',
                enterFullscreen: 'Tela cheia',
                pip: 'Video flutuante',
            },
            controls: [
                'play-large',
                'play',
                'rewind',
                'current-time',
                'duration',
                'mute',
                'volume',
                'captions',
                'settings',
                'pip',
                'airplay',
                'fullscreen',
                'quality'
            ],
            clickToPlay: true,
            keyboard: {
                focused: false,
                global: false
            },
            displayDuration: false,
            fullscreen: {
                enabled: true,
                fallback: true,
                iosNative: false,
                container: null
            },
            tooltips: {
                controls: true,
                seek: false,
                volume: true,
                fullscreen: true,
                pip: true,
                speed: false,
            },
            speed: {
                selected: 1,
                options: [0.5, 0.75, 1, 1.25, 1.5]
            },
            settings: {
                quality: true,
                speed: false,
                loop: true,
                captions: true,
            }
        });

        // Add to our collection of Plyr instances
        players.push(instance);
    }

    // Return the players for chaining
    return players;
}

player = plyr("video")
window.player = player;
player[0].on('ended', event => {
    console.log("Time %s | End: %s", player[0].currentTime, player[0].duration)
    if (document.querySelector("#asistido")) {
        Swal.fire({
            title: 'Você Concluiu o Tópico!',
            text: "Clique em 'OK' para marcar o tópico como assistido!",
            icon: 'success',
            showCloseButton: false,
            showCancelButton: false,
            focusConfirm: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            confirmButtonColor: '#15a362',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                marcarAssistido(document.querySelector("#asistido"))
                Swal.fire({
                    title: 'Aguarde!',
                    didOpen: () => {
                        Swal.showLoading()
                    },
                })
            }
        });
        // marcarAssistido($.get("#asistido"))
    }
});

if ('mediaSession' in navigator) {
    navigator.mediaSession.metadata = new MediaMetadata({
        title: 'EAD IPMIL',
        artist: '1.1 – REPRESENTAÇÃO DOS CONJUNTOS',
        album: 'MATEMÁTICA',
        artwork: [{
                src: 'https://i.vimeocdn.com/video/1122930966-009d16b1dbfc65f52954e28e4165d86a62a4a7af0266e880c0984d5cac7c3ec4-d_96x96',
                sizes: '96x96',
                type: 'image/png'
            },
            {
                src: 'https://i.vimeocdn.com/video/1122930966-009d16b1dbfc65f52954e28e4165d86a62a4a7af0266e880c0984d5cac7c3ec4-d_128x128',
                sizes: '128x128',
                type: 'image/png'
            },
            {
                src: 'https://i.vimeocdn.com/video/1122930966-009d16b1dbfc65f52954e28e4165d86a62a4a7af0266e880c0984d5cac7c3ec4-d_192x192',
                sizes: '192x192',
                type: 'image/png'
            },
            {
                src: 'https://i.vimeocdn.com/video/1122930966-009d16b1dbfc65f52954e28e4165d86a62a4a7af0266e880c0984d5cac7c3ec4-d_256x256',
                sizes: '256x256',
                type: 'image/png'
            },
            {
                src: 'https://i.vimeocdn.com/video/1122930966-009d16b1dbfc65f52954e28e4165d86a62a4a7af0266e880c0984d5cac7c3ec4-d_384x384',
                sizes: '384x384',
                type: 'image/png'
            },
            {
                src: 'https://i.vimeocdn.com/video/1122930966-009d16b1dbfc65f52954e28e4165d86a62a4a7af0266e880c0984d5cac7c3ec4-d_512x512',
                sizes: '512x512',
                type: 'image/png'
            },
        ]
    });
    navigator.mediaSession.setActionHandler('seekto', function () {
        return
    });
}

docinfo = [{
    "id": "12",
    "titulo": "Logo",
    "descricao": "Logo do IPMIL",
    "arquivo": "20220316192514.png",
    "status": "1",
    "id_curso": "0",
    "id_modulo": "0",
    "id_aula": "0",
    "exclusivo": "0",
    "download": "1"
}, {
    "id": "16",
    "titulo": "Manual do Aluno",
    "descricao": "Estabelece normas e regulamentos",
    "arquivo": "20220318012450.pdf",
    "status": "1",
    "id_curso": "54",
    "id_modulo": "0",
    "id_aula": "0",
    "exclusivo": "0",
    "download": "1"
}]; // JSON
console.log(docinfo);

function viewBook(o) {
    if (!o.dataset.bsToggle) {
        bookId = o.dataset.bookid
        bookExt = o.dataset.bookext
        docName = o.dataset.docname
        let d = document.querySelector(".modal-books");
        bookId = o.dataset.bookid,
            modal = document.createElement("div"),
            modal.classList.add("modal"),
            modal.classList.add("fade"),
            modal.setAttribute("id", "book_" + bookId),
            modal.setAttribute("tabindex", "-1"),
            modal.setAttribute("aria-labelledby", "book_" + bookId + "Label"),
            modal.setAttribute("aria-hidden", "true"),
            modalDialog = document.createElement("div"),
            modalDialog.classList.add("modal-dialog"),
            modalDialog.classList.add("modal-fullscreen"),
            modalContent = document.createElement("div"),
            modalContent.classList.add("modal-content"),
            modalHeader = document.createElement("div"),
            modalHeader.classList.add("modal-header"),
            modalTitle = document.createElement("h5"),
            modalTitle.classList.add("modal-title"),
            modalTitle.setAttribute("id", "book_" + bookId + "Label"),
            modalTitle.innerHTML = docName,
            modalClose = document.createElement("button"),
            modalClose.classList.add("btn-close"),
            modalClose.setAttribute("data-bs-dismiss", "modal"),
            modalClose.setAttribute("aria-label", "Close"),
            modalBody = document.createElement("div"),
            modalBody.classList.add("modal-body"),
            modalBody.setAttribute("id", "book_" + bookId + "Body"),
            modalHeader.appendChild(modalTitle),
            modalHeader.appendChild(modalClose),
            modalContent.appendChild(modalHeader),
            modalContent.appendChild(modalBody),
            modalDialog.appendChild(modalContent),
            modal.appendChild(modalDialog),
            d.appendChild(modal),
            modalAction = o,
            modalAction.setAttribute("data-bs-toggle", "modal"),
            modalAction.setAttribute("data-bs-target", "#book_" + bookId),
            modalAction.click()
    }
    o.dataset.open || (
        o.dataset.open = !0,
        jQuery("#book_" + bookId + "Body").FlipBook({
            pdf: "https://ead.ipadraomilitar.com.br/uploads/" + bookId + "." + bookExt,
            template: {
                html: "https://ead.ipadraomilitar.com.br/assets/flipbook/templates/default-book-view.html",
                styles: ["https://ead.ipadraomilitar.com.br/assets/flipbook/css/black-book-view.css"],
                links: [{
                    rel: "stylesheet",
                    href: "https://ead.ipadraomilitar.com.br/assets/flipbook/css/font-awesome.min.css"
                }],
                script: "https://ead.ipadraomilitar.com.br/assets/flipbook/js/default-book-view.js",
                theme: "dark-shadow"
            },
            sounds: {
                startFlip: 'https://ead.ipadraomilitar.com.br/assets/flipbook/sounds/start-flip.mp3',
                endFlip: 'https://ead.ipadraomilitar.com.br/assets/flipbook/sounds/end-flip.mp3'
            },
            controlsProps: {
                actions: {
                    cmdBackward: {
                        code: 37
                    },
                    cmdForward: {
                        code: 39
                    },
                    cmdSave: {
                        code: 68,
                        flags: 1
                    },
                    cmdPrint: {
                        enabled: !1,
                        enabledInNarrow: !1
                    },
                    // cmdToc: {
                    //     enabled: !1,
                    //     enabledInNarrow: !1
                    // },
                    cmdThumbnails: {
                        enabled: !1,
                        enabledInNarrow: !1
                    }
                },
                loadingAnimation: {
                    book: !1
                },
                autoResolution: {
                    enabled: !1
                },
                scale: {
                    max: 4
                }
            }
        })
    )
}