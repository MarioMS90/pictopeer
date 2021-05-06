import { NgModule } from "@angular/core";
import { RouterModule, Routes } from "@angular/router";
import { ActivityTypePageComponent } from "./activity-type-page.component";

const routes: Routes = [
    {
        path: '',
        component: ActivityTypePageComponent,
        children: [

        ],
    },
];

@NgModule({
    imports: [
        RouterModule.forChild(routes)
    ],
    exports: [RouterModule]
})

export class ActivityTypeRoutingModule { }