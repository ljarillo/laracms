<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDetailPlan;
use App\Http\Requests\StoreUpdatePlan;
use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class DetailPlanController extends Controller
{
    private $repository, $plan;

    /**
     * @param DetailPlan $detailPlan
     * @param Plan $plan
     */
    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->repository = $detailPlan;
        $this->plan = $plan;
    }

    /**
     * @param $urlPlan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index($urlPlan)
    {
        if(!$plan = $this->plan->where('url', $urlPlan)->first()){
            return redirect()->back();
        }

        $details = $plan->details()->paginate();

        return view('admin.pages.plans.details.index', compact('plan', 'details'));
    }

    /**
     * @param $urlPlan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create($urlPlan)
    {
        if(!$plan = $this->plan->where('url', $urlPlan)->first()){
            return redirect()->back();
        }

        return view('admin.pages.plans.details.create', compact('plan'));
    }

    /**
     * @param StoreUpdateDetailPlan $request
     * @param $urlPlan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUpdateDetailPlan $request, $urlPlan)
    {
        if(!$plan = $this->plan->where('url', $urlPlan)->first()){
            return redirect()->back();
        }

        $plan->details()->create($request->all());

        return redirect()->route('details.index', $plan->url);
    }

    /**
     * @param $urlPlan
     * @param $idDetail
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);

        if(!$plan || !$detail){
            return redirect()->back();
        }

        return view('admin.pages.plans.details.show', compact('plan', 'detail'));

    }

    /**
     * @param $urlPlan
     * @param $idDetail
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);

        if(!$plan || !$detail){
            return redirect()->back();
        }

        return view('admin.pages.plans.details.edit', compact('plan', 'detail'));
    }

    /**
     * @param StoreUpdateDetailPlan $request
     * @param $urlPlan
     * @param $idDetail
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreUpdateDetailPlan $request, $urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);

        if(!$plan || !$detail){
            return redirect()->back();
        }

        $detail->update($request->all());

        return redirect()->route('details.index', $plan->url);
    }

    /**
     * @param $urlPlan
     * @param $idDetail
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);

        if(!$plan || !$detail){
            return redirect()->back();
        }

        $detail->delete();

        return redirect()
            ->route('details.index', $plan->url)
            ->with('message', 'Registro deletado com sucesso');
    }
}
