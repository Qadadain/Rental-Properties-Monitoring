<?php

namespace App\Controller;

use App\Entity\RentReceipt;
use App\Entity\Tenant;
use App\Form\RentReceiptType;
use App\Repository\RentReceiptRepository;
use App\Repository\TenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Snappy\Pdf;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/quittance-de-loyer", name="rent_receipt_")
 */
class RentReceiptController extends AbstractController
{

    /**
     * @Route("/add", name="add")
     */
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $rentReceipt = new RentReceipt();
        $form = $this->createForm(RentReceiptType::class, $rentReceipt);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($rentReceipt);
            $em->flush();
            return $this->redirectToRoute('home_index');
        }
        return $this->render('add/rentReceipt.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/pdf/pdf/{locataireFirstName}-{locataireLastName}-{id}", name="show")
     */
    public function getRentReceiptByTenant(Tenant $tenant, EntityManagerInterface $em, PaginatorInterface $paginator, Request $request): Response
    {
        $rentReceiptRepository = $em->getRepository('App:RentReceipt');

        $data = $rentReceiptRepository->findBy(['tenant' => $tenant], ['date' => 'desc']);

        $rentReceipts = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            12
        );
        return $this->render('show/tenantRentReceipt.html.twig', [
            'tenant' => $tenant,
            'rentReceipts' => $rentReceipts,
        ]);
    }

    /**
     * @Route("/pdf/pdf-{id}", name="pdf")
     * @throws Exception
     */
    public function pdfAction(RentReceiptRepository $rentReceiptRepository, Pdf $knpSnappyPdf, int $id)
    {
        $rentReceipt = $rentReceiptRepository->findOneBy(['id' => $id]);
        $html = $this->renderView('/_Components/pdf/rentReceipt.html.twig', [
            'user' => $this->getUser(),
            'rentReceipt' => $rentReceipt,
        ]);

        $knpSnappyPdf->setOption('encoding', 'UTF-8');

        $date = date_format($rentReceipt->getDate(), 'm-Y');
        $tenant = mb_strtolower($rentReceipt->getTenant(), 'UTF-8');
        $tenant = str_replace(' ', '-', $tenant);
        $tenant = TenantRepository::pdf_str_replace($tenant);
        dump($date, $tenant);

        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html),
            "loyer-$tenant-$date.pdf"
        );
    }
}
