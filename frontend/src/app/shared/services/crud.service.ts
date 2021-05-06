import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

export abstract class AbstractCrudService<T> {
  constructor(private http: HttpClient, private endpoint) {}

  findAll(): Observable<T[]> {
    return this.http.get<T[]>(this.endpoint);
  }
  findOneById(id: number): Observable<T> {
    return this.http.get<T>(`${this.endpoint}/${id}`);
  }
  add(data): Observable<T> {
    return this.http.post<T>(`${this.endpoint}`, data);
  }
  update(data): Observable<T> {
    return this.http.put<T>(`${this.endpoint}`, data);
  }
}
