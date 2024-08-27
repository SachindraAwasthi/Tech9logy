<?php
namespace Tech9logy\CouponCode\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Tech9logy\CouponCode\Model\CampaignsFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends Action
{
    /**
     * @var CampaignsFactory
     */
    protected $campaignsFactory;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var UploaderFactory
     */
    protected $uploaderFactory;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @param Action\Context $context
     * @param CampaignsFactory $campaignsFactory
     * @param DataPersistorInterface $dataPersistor
     * @param UploaderFactory $uploaderFactory
     * @param Filesystem $filesystem
     */
    public function __construct(
        Action\Context $context,
        CampaignsFactory $campaignsFactory,
        DataPersistorInterface $dataPersistor,
        UploaderFactory $uploaderFactory,
        Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->campaignsFactory = $campaignsFactory;
        $this->dataPersistor = $dataPersistor;
        $this->uploaderFactory = $uploaderFactory;
        $this->filesystem = $filesystem;
    }

    /**
     * Save campaign record action
     *
     * @return Redirect
     */
    public function execute()
    {
        // Retrieve POST data
        $postData = $this->getRequest()->getPostValue();
        // Create a redirect result instance
        $resultRedirect = $this->resultRedirectFactory->create();

        // Check if POST data exists
        if ($postData) {
            $model = $this->campaignsFactory->create();

            // Retrieve the ID parameter from the request
            $id = isset($postData['id']) ? $postData['id'] : null;

            // Load the model if ID exists
            if ($id) {
                $model->load($id);
            }

            try {
                // Check if a file was uploaded
                $fileId = 'add_image';
                $file = $this->getRequest()->getFiles($fileId);
                if ($file && isset($file['name']) && $file['name'] != '') {
                    $uploader = $this->uploaderFactory->create(['fileId' => $fileId]);
                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(true);

                    $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
                    $destinationPath = $mediaDirectory->getAbsolutePath('Tech9logy_CouponCode/images/');

                    $result = $uploader->save($destinationPath);
                    $postData['add_image'] = 'Tech9logy_CouponCode/images/' . $result['file'];
                }

                // Update model data with new POST data including image path
                $model->setData($postData);
                $model->save();

                // Display success message
                $this->messageManager->addSuccessMessage(__('The data has been saved.'));

                // Clear the data from session
                $this->dataPersistor->clear('tech9logy_campaigns_form_data');

                // Redirect to the grid or continue editing
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the data.'));
            }

            // Persist the data in session
            $this->dataPersistor->set('tech9logy_campaigns_form_data', $postData);

            // Redirect back to the edit page with the ID parameter
            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        }

        // If no POST data, redirect to the grid
        return $resultRedirect->setPath('*/*/');
    }
}
