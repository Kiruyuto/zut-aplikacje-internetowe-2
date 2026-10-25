# Diagram ERD pogodynki — notacja Chena

Prostokąty oznaczają encje, owalne węzły — atrybuty, a romb — relację. Diagram wykorzystuje [składnię flowchart Mermaid](https://mermaid.js.org/syntax/flowchart.html).

```mermaid
flowchart LR
    M_ID(["id (PK)"]) --- M
    M_NAZWA(["name"]) --- M
    M_KRAJ(["country_code"]) --- M
    M_SZER(["latitude"]) --- M
    M_DL(["longitude"]) --- M

    M["Location"] ---|"1"| R{"has measurements"}
    R ---|"0..N"| P["WeatherMeasurement"]

    P --- P_ID(["id (PK)"])
    P --- P_CZAS(["measured_at (UTC)"])
    P --- P_TEMP(["temperature (°C)"])
    P --- P_CIS(["pressure (hPa)"])
    P --- P_WILG(["humidity (%)"])
    P --- P_PRED(["wind_speed (m/s)"])
    P --- P_KIER(["wind_direction (°)"])
    P --- P_ZACH(["cloud_cover (%)"])

    classDef encja fill:#fff,stroke:#222,stroke-width:2px,color:#111;
    classDef atrybut fill:#fff,stroke:#222,stroke-width:1.5px,color:#111;
    classDef relacja fill:#fff,stroke:#222,stroke-width:2px,color:#111;
    class M,P encja;
    class R relacja;
    class M_ID,M_NAZWA,M_KRAJ,M_SZER,M_DL,P_ID,P_CZAS,P_TEMP,P_CIS,P_WILG,P_PRED,P_KIER,P_ZACH atrybut;
    linkStyle default stroke:#222,stroke-width:1.5px;
```

`PK` oznacza klucz główny. Encja `Location` reprezentuje miejscowość, a `WeatherMeasurement` — pomiar pogody. Relacja `1 : 0..N` oznacza, że miejscowość może mieć od zera do wielu pomiarów, a każdy pomiar należy do jednej miejscowości. W modelu relacyjnym tę relację realizuje klucz obcy `WeatherMeasurement.location_id` wskazujący na `Location.id`.
