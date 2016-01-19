<?php
namespace AppBundle\Controller;

use Imagine\Gd\Imagine;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Helper;
use AppBundle\Entity;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Cookie;
#use AppBundle\Weibo;
#use Imagine\Image\Box;
#use Imagine\Image\Point;
#use Imagine\Image\ImageInterface;
#use Symfony\Component\Filesystem\Filesystem;

#use Symfony\Component\Validator\Constraints\Image;

class DefaultController extends Controller
{
	/**
	 * @Route("/", name="_index")
	 */
	public function indexAction(Request $request)
	{
		$repository = $this->getDoctrine()->getRepository('AppBundle:Storage');
		$query = $repository->createQueryBuilder('p')->orderBy('p.district', 'ASC')->getQuery();
		$storages = $query->getResult();
		return $this->render('AppBundle:default:index.html.twig',array('storages'=>$storages));
	}

	/**
	 * @Route("/event/list", name="_event_list")
	 */
	public function eventListAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('AppBundle:Event');
		$queryBuilder = $repository->createQueryBuilder('a');
		$events = $queryBuilder
		->setFirstResult(0)
		->setMaxResults(10)
		->orderBy('a.createTime','DESC')
		->getQuery()
		->getResult();
		return $this->render('AppBundle:default:eventList.html.twig',array(
			'events'=>$events
		));
	}

	/**
	 * @Route("/event/{id}", name="_event")
	 */
	public function eventAction(Request $request, $id)
	{
		$event = $this->getDoctrine()->getRepository('AppBundle:Event')->find($id);
		return $this->render('AppBundle:default:event.html.twig',array(
			'event'=>$event
		));
	}
	/**
	 * @Route("/city", name="_city")
	 */
	public function cityAction(Request $request)
	{
		if( null == $request->get('district') ){
			return new Response(json_encode(array('ret'=>1001,'msg'=>'错误的请求')));
		}
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('AppBundle:Storage');
		$queryBuilder = $repository->createQueryBuilder('a');
		$storages = $queryBuilder
		->where('a.district = :district')
		->setParameter('district', urldecode($request->get('district')))
		->groupBy('a.city')
		->getQuery()
		->getResult();
		$cities = array();
		foreach ($storages as $key => $storage) {
			$cities[] = $storage->getCity();
		}
		$result = array(
			'ret' => 0,
			'data' => $cities,
		);
		return new Response(json_encode($result));
	}
	/**
	 * @Route("/storages/list/json", name="_storage_list_json")
	 */
	public function storageJsonAction(Request $request)
	{
		if( null == $request->get('city') ){
			return new Response(json_encode(array('ret'=>1001,'msg'=>'错误的请求')));
		}
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('AppBundle:Storage');
		$queryBuilder = $repository->createQueryBuilder('a');
		$storages = $queryBuilder
		->where('a.city = :city')
		->setParameter('city', urldecode($request->get('city')))
		->getQuery()
		->getResult();
		$data = array();
		foreach ($storages as $key => $storage) {
			$data[] = array('id'=>$storage->getId(),'title'=>$storage->getTitle());
		}
		$result = array(
			'ret' => 0,
			'data' => $data,
		);
		return new Response(json_encode($result));
	}
	/**
	 * @Route("/storages/list", name="_storage_list")
	 */
	public function storageListAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('AppBundle:Storage');
		$queryBuilder = $repository->createQueryBuilder('a');
		$queryBuilder
		->where('a.district = :district AND a.city = :city AND a.area >= :area1 AND a.area < :area2')
		->setParameter('district', urldecode($request->get('district')))
		->setParameter('city', urldecode($request->get('city')));
		switch ($request->get('area')) {
			case '1':
				$queryBuilder->setParameter('area1', 0)->setParameter('area2', 10000);
				break;
			
			case '2':
				$queryBuilder->setParameter('area1', 10000)->setParameter('area2', 20000);
				break;

			case '3':
				$queryBuilder->setParameter('area1', 20000)->setParameter('area2', 30000);
				break;

			case '4':
				$queryBuilder->setParameter('area1', 30000)->setParameter('area2', 99999999999);
				break;

			default:
				$queryBuilder->setParameter('area1', 0)->setParameter('area2', 0);
				break;
		}
		$storages = $queryBuilder->getQuery()->getResult();
		if( null != $storages){
			$data = array();
			foreach( $storages as $storage){
				$data[] = array(
					'title' => $storage->getTitle(),
					'visitUrl' => $this->generateUrl('_visit',array('id'=>$storage->getId())),
					'detailUrl' => $this->generateUrl('_storage',array('id'=>$storage->getId())),
					'imgUrl' => $storage->getImgUrl(),
				);
			}
			$result = array(
				'ret' => 0,
				'data' => $data,
			);
		}
		else{
			$result = array(
				'ret' => 1001,
				'data' => '无结果',
			);
		}
		
		return new Response(json_encode($result));
	}
	/**
	 * @Route("/visit/{id}", name="_visit")
	 */
	public function visitAction(Request $request, $id)
	{
		$storage = $this->getDoctrine()->getRepository('AppBundle:Storage')->find($id);
		if(null == $storage){
			return $this->redirect($this->generateUrl('_index'));
		}

		return $this->render('AppBundle:default:visit.html.twig',array(
			'storage'=>$storage,
		));

	}
	/**
	 * @Route("/map/{id}", name="_map")
	 */
	public function mapAction(Request $request, $id)
	{
		$storage = $this->getDoctrine()->getRepository('AppBundle:Storage')->find($id);
		if(null == $storage){
			return $this->redirect($this->generateUrl('_index'));
		}

		return $this->render('AppBundle:default:map.html.twig',array(
			'storage'=>$storage,
		));
	}
	/**
	 * @Route("/storage/{id}", name="_storage")
	 */
	public function storageAction(Request $request, $id)
	{
		$storage = $this->getDoctrine()->getRepository('AppBundle:Storage')->find($id);
		if(null == $storage){
			return $this->redirect($this->generateUrl('_index'));
		}

		return $this->render('AppBundle:default:storage.html.twig',array(
			'storage'=>$storage,
		));
		
	}
	/**
	 * @Route("/post", name="_visit_post")
	 */
	public function postAction(Request $request)
	{
		if($request->getMethod() == 'POST'){
			$em = $this->getDoctrine()->getEntityManager();
			$storage = $this->getDoctrine()->getRepository('AppBundle:Storage')->find($request->get('storage'));
			$mobile = strip_tags(trim($request->get('mobile')));
			$username = strip_tags(trim($request->get('username')));
			$company = strip_tags(trim($request->get('company')));
			$visit = new Entity\Visit();
			$visit->setStorage($storage);
			$visit->setMobile($mobile);
			$visit->setUsername($username);
			$visit->setCompany($company);
			$visit->setCreateTime(new \DateTime("now"));
			$visit->setCreateIp($this->container->get('request')->getClientIp());
			$em->persist($visit);
			$em->flush();
			$result = array(
				'ret' => 0,
				'data' => '',
			);
		}
		else{

			$result = array(
				'ret' => 1001,
				'data' => '来源不正确~',
			);
		}
		return new Response(json_encode($result));
	}
}
