const wrapperList = document.querySelector("#wrapper-list")
const cities = [
  "toluca",
  "tlalnepantla",
  "veracruz",
  "puebla",
  "leon",
  "queretaro",
  "xalapa",
  "nicolas-romero",
  "metepec",
  "zinancatepec",
  "san-mateo",
  "hermosillo",
  "obregon",
  "mochis",
  "culiacan",
  "mazatlan",
  "torreon",
  "morelia",
  "guadalajara",
  "tuxtla",
]
const orangeCamp = ["fb-branding", "web", "conv", "video"]

function renderList(cities, camps) {
  cities.forEach((city) => {
    let title = document.createElement("h5")
    let text = document.createTextNode(city)
    title.appendChild(text)
    wrapperList.appendChild(title)

    camps.forEach((campaignName) => {
      let link = document.createElement("a")
      let text = document.createTextNode(
        `https://megacable-promociones.com.mx/netflix/?campaign=${campaignName}&city=${city}&ag=or&page=entry`
      )
      link.appendChild(text)
      link.href = `https://megacable-promociones.com.mx/netflix/?campaign=${campaignName}&city=${city}&ag=or&page=entry`
      link.target = "_blank"
      wrapperList.appendChild(link)
    })
  })
}

renderList(cities, orangeCamp)
