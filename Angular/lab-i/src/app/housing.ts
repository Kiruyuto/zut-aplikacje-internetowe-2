import { Injectable } from '@angular/core';
import type { HousingLocationInfo } from './housinglocation';

@Injectable({
  providedIn: 'root',
})
export class Housing {
  url = 'http://localhost:48452/locations';

  async getAllHousingLocations(): Promise<HousingLocationInfo[]> {
    const data = await fetch(this.url);
    return (await data.json()) ?? [];
  }

  async getHousingLocationById(id: number): Promise<HousingLocationInfo | undefined> {
    const data = await fetch(`${this.url}?id=${id}`);
    const locationJson = await data.json();
    return locationJson[0] ?? undefined;
  }
}
