const $ = jQuery
export default class MobileShare {
  constructor(el) {
    this.el = el
    this.selectors = {
      h2: el.querySelectorAll('h2'),
    }
    this.init()
  }

  init() {
    this.bindEvents()
  }

  copyTextBtn() {
    const copyTextBtn = document.createElement('button');
    copyTextBtn.innerText = 'copia codice'
    $(copyTextBtn).attr({
      class: 'button',
      type: 'submit'
    })
    $(copyTextBtn).css({
      padding: '.875rem 1.125rem',
      width: '100%',
      outline: 0,
      textAlign: 'center'
    })
    copyTextBtn.addEventListener('click', ()=>{
      navigator.clipboard.writeText(97096120585)
      copyTextBtn.style.backgroundColor = "rgb(255 0 0)"
      copyTextBtn.innerText = "copiato"
      setTimeout(()=>{
        copyTextBtn.innerText = "copia codice"
        copyTextBtn.style.backgroundColor = "#c72828"
      }, 1000)
    })
    return copyTextBtn
  }

  shareSMS() {
    const shareSMSBtn = document.createElement('a');
    shareSMSBtn.innerText = 'condividi tramite sms'
    $(shareSMSBtn).attr({
      class: 'button',
      href: 'sms:?&body=Il codice fiscale di MSF:  97096120585'
    })
    $(shareSMSBtn).css({
      padding: '.875rem 1.125rem',
      width: '100%',
      marginTop: '10px',
      marginBottom: '10px',
      textDecoration: 'none',
      color: '#fff',
      textAlign: 'center'
    })
    return shareSMSBtn
  }

  shareWatsApp() {
    const shareWatsAppBtn = document.createElement('a');
    shareWatsAppBtn.innerText = 'condividi tramite whatsapp'
    $(shareWatsAppBtn).attr({
      class: 'button',
      target: '_blank',
      rel: "noopener",
      href: 'https://api.whatsapp.com/send?text=Dona%20il%20tuo%205x1000%20a%20Medici%20Senza%20Frontiere%2C%20Codice%20fiscale%2097096120585.%20Per%20info%20http%3A%2F%2Fmsf.it/5x1000'
    })
    $(shareWatsAppBtn).css({
      padding: '.875rem .6rem',
      width: '100%',
      marginTop: '10px',
      textDecoration: 'none',
      color: '#fff',
      textAlign: 'center'
    })
    return shareWatsAppBtn
  }

  bindEvents() {
    this.el.appendChild(this.copyTextBtn())
    this.el.appendChild(this.shareWatsApp())
    if(navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/iPhone/i)){
      this.el.appendChild(this.shareSMS())
    }
  }

}
